<?php
// Check quyen nguoi dung
class AuthIsLogin extends Middlewares
{
    private $res = null;
    function __construct()
    {
        $this->res = new Response;
    }
    function handle()
    {
        $this->checkLogin();
    }

    private function checkLogin()
    {

        $accessToken = null;

        //Check accessToken
        if (!empty(Session::get('userLogin'))) {
            $accessToken = JWT::verifyJWT(Session::get('userLogin')) ?? '';
        } else {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập.', 'home');
        }


        //check accessToken con han
        if (!empty($accessToken) && isset($accessToken['error'])) {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập.', 'home');
        }

        $dataUserCurrent = $accessToken['payload'];
        if ($dataUserCurrent['isBlock'] == 1) {
            return $this->res->setToastSession('error', 'Tài khoản đã bị khoá vui lòng thử lại.', 'home');
        }
    }
}
