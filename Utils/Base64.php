<?php

class Base64
{
    public static function base64ToImage($base64)
    {
        $data = str_replace('data:image/jpeg;base64,','',$base64);
        return base64_decode($data);
    }

    public static function imageToBase64($image){
        return base64_encode($image);
    }
}