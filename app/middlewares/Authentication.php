<?php
// Check dang nhap nguoi dung
class Authentication extends Middlewares
{
    function handle()
    {
        $this->checkedLogin();
    }

    private function checkedLogin()
    {
        $refreshToken = null;
        $accessToken = null;

        //Check accessToken
        if (!empty(Session::get('userLogin'))) {
            $accessToken = JWT::verifyJWT(Session::get('userLogin')) ?? '';
        }

        //check accessToken con han
        if (!empty($accessToken) && $accessToken['valid'] && !isset($accessToken['error'])) {
            return;
        }

        // Check refreshToken
        if (!empty(Cookie::get('keepLogin'))) {
            $refreshToken = JWT::verifyJWT(Cookie::get('keepLogin')) ?? '';
        }


        // Check refeshToken con han
        if (!empty($refreshToken) && $refreshToken['valid'] && !isset($refreshToken['error'])) {
            $user_id = $refreshToken['payload']['refreshToken'];

            $dataUserDb = $this->db->findById('user', 'id AS user_id, role_id, fullname, isBlock', $user_id);
            //check user has blocked
            if ($dataUserDb['isBlock'] == 1) {
                Cookie::unsetCookie('keepLogin');
                Session::destroy();
                return;
            }
            //create new accessToken;
            $dataAccessToken = JWT::createJWT($dataUserDb, (2 * 3600)); // 2h
            //Set accessToken to session
            Session::set('userLogin', $dataAccessToken);
        } else {
            //RefeshToken het han thi dang xuat
            Cookie::unsetCookie('keepLogin');
            Session::destroy();
            return;
        }
    }
}
