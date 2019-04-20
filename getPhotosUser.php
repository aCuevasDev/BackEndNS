<?php
require_once('Utils/Util.php');
require_once('Token.php');
require_once('DAO/PhotosDAO.php');
require_once('Utils/Base64.php');

$headers = Util::getAllHeaders();
$user = Token::getUserFromToken($headers);
$paramMap = $_GET;

if ($user != false) {
    if ($paramMap['usrCode'] != null) {
        $usrCode = $paramMap['usrCode'];
        $photosDAO = new PhotosDAO();
        $photosArr = $photosDAO->getPhotosUser($usrCode);
        $photos = [];
        foreach ($photosArr as $photo) {
            $img = file_get_contents($photo['photo']);
            $base64 = Base64::imageToBase64($img);
            $photo['photo'] = $base64;
            array_push($photos, $photo);
        }
        $result = Util::generateOKJSON($photos);

    } else $result = Util::generateErrorJSON('invalid parameters');
} else $result = Util::generateErrorAuth();

echo $result;
