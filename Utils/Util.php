<?php

class Util
{
    public static function generateOKJSON($data)
    {
        $arr = ['data' => $data, 'message' => 'ok', 'code' => 0];
        return json_encode($arr, JSON_UNESCAPED_SLASHES);
    }

    public static function generateErrorJSON($message)
    {
        $arr = ['message' => $message, 'code' => 1];
        return json_encode($arr, JSON_UNESCAPED_SLASHES);
    }

    public static function generateErrorAuth()
    {
        $arr = ['message' => 'invalid authentication', 'code' => 2];
        return json_encode($arr, JSON_UNESCAPED_SLASHES);
    }
}