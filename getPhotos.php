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

    $result = Util::generateOKJSON($photosArr);
} else $result = Util::generateErrorAuth();

echo $result;
