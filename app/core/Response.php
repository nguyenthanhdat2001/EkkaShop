<?php class Response
{
    function redirect($uri = "")
    {
        $url = '/ecommerce_php_5_1/' . $uri;
        header('location:' . $url);
        exit;
    }

    function dataApi($code, $mess, $data = [])
    {
        $data = [
            'code' => $code,
            'message' => $mess,
            'data' => $data,
        ];
        return json_encode($data);
    }

    function setToastSession($type, $mess, $uri = '')
    {
        Session::set('toastType', $type);
        Session::set('toastMessage', $mess);
        if (!empty($uri)) {
            return $this->redirect($uri);
        }
        return;
    }
}
