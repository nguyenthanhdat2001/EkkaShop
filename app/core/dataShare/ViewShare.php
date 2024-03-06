<?php
class ViewShare
{
    static $dataShare = [];

    static function share($key, $value)
    {
        self::$dataShare[$key] = $value;
    }
}
