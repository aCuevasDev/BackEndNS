<?php

class Base64
{
    public static function base64ToImage($base64)
    {
        $data = explode(',', $base64);
        return base64_decode($data[1]);
    }

    public static function imageToBase64($image){
        return base64_encode($image);
    }
}