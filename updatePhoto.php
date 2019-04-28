<?php
require_once('Token.php');
require_once('Model/Photo.php');
require_once('DAO/PhotosDAO.php');
require_once('Utils/Util.php');
require_once('Utils/Base64.php');

define('directory', '../savedPhotos/');

$headers = Util::getAllHeaders();
$user = Token::getUserFromToken($headers);
$body = file_get_contents('php://input');
$photo = json_decode($body, true);

if ($user != false) {
    if ($photo['photo'] == null)
        $result = Util::generateErrorJSON('Invalid parameters');
    else {
        $photosDAO = new PhotosDAO();

        $base64 = $photo['photo'];
        $img = Base64::base64ToImage($base64);
        $idPhoto = $photo['id'];
        $fileName = $photosDAO->getPhoto($idPhoto)['photo'];
        file_put_contents($fileName, $img);

        $photo['photo'] = $fileName;
        $code = $user->getCode();
        $photoObj = new Photo();
        $photoObj->create($code);
        $photoObj->setPhotoData($photo);
        $daoRes = $photosDAO->updatePhoto($photoObj);
        $result = Util::generateOKJSON($fileName);
    }
} else $result = Util::generateErrorAuth();

echo $result;
