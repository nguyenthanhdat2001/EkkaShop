<?php
class Route
{
    private $keyRoute = null;
    function handleRoute($url)
    {
        //Lấy ra routes
        global $routes;

        //Loải bỏ phần từ đầu tiên
        unset($routes['default_controller']);

        if (!empty($url)) {
            // Lấy url mà tạo thành chuỗi
            $url = implode('/', $url);

            $handleUrl = $url;
            if (!empty($routes)) {
                foreach ($routes as $key => $value) {
                    if (preg_match('~' . $key . '~is', $url)) {
                        $handleUrl = preg_replace('~' . $key . '~is', $value, $url);
                        $this->keyRoute = $key;
                    }
                }
            }
            //Chuyển thành mảng
            $handleUrl = explode('/', $handleUrl);
        } else {
            $handleUrl = '';
        }
        return $handleUrl;
    }

    function getKeyRoute()
    {
        return $this->keyRoute;
    }
}
