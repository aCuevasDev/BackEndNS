<?php
require_once('Utils/Util.php');
require_once('Token.php');
require_once('DAO/PhotosDAO.php');
require_once('Utils/Base64.php');

$headers = Util::getAllHeaders();
$user = Token::getUserFromToken($headers);

if ($user != false) {
    $photosDAO = new PhotosDAO();
    $photosArr = $photosDAO->getAllPhotos();
    $photos = [];
    foreach ($photosArr as $photo) {
        $img = file_get_contents($photo['photo']);
        $base64 = Base64::imageToBase64($img);
        $photo['photo'] = $base64;
        array_push($photos, $photo);
    }
    $result = Util::generateOKJSON($photos);
} else $result = Util::generateErrorAuth();

echo $result;
