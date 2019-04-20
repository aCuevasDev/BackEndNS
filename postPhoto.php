<?php
require_once('Token.php');
require_once('Utils/Util.php');
require_once('Utils/Base64.php');

// TODO AUTHENTICATION

define('directory', '../savedPhotos/');

$headers = apache_request_headers();
$user = Token::getUserFromToken($headers);
$body = file_get_contents('php://input');
$photo = json_decode($body, true);

if ($photo['photo'] == null)
    $result = Util::generateErrorJSON('invalid parameters');
else {
//    if ($photo instanceof Photo) {
    $base64 = $photo['photo'];
    $img = Base64::base64ToImage($base64);
    if (!file_exists(directory))
        mkdir(directory);
    $fileName = directory . uniqid('photo') . '.jpg';
    file_put_contents($fileName, $img);
    $result = Util::generateOKJSON($fileName);
//    } else $result = Util::generateErrorJSON('error inserting photo');
}

echo $result;