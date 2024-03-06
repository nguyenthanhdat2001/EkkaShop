<?php
class Cookie
{
    public static function set($key, $val, $expire = (15 * 60), $path = "/", $domain = "", $secure = false, $httpOnly = true)
    {
        setcookie($key, $val, time() + $expire, $path, $domain, $secure, $httpOnly);
    }

    public static function get($key)
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : false;
    }

    public static function checkCookie($key)
    {
        return isset($_COOKIE[$key]);
    }

    public static function unsetCookie($key)
    {
        if (self::checkCookie($key)) {
            setcookie($key, "", time() - 3600, "/");
        }
    }
}
