<?php

class Util
{
    public static function generateOKJSON($data)
    {
        $arr = ['data' => $data, 'message' => 'ok'];
        return json_encode($arr);
    }

    public static function generateErrorJSON($message){
        $arr = array('message' => $message);
        return json_encode($arr);
    }
}