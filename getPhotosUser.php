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

        $result = Util::generateOKJSON($photosArr);

    } else $result = Util::generateErrorJSON('invalid parameters');
} else $result = Util::generateErrorAuth();

echo $result;
