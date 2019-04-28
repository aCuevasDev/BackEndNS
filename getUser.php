<?php
require_once('Model/User.php');
require_once('DAO/UsersDAO.php');

$headers = Util::getAllHeaders();
$user = Token::getUserFromToken($headers);

if ($user != false) {
    $paramMap = $_GET;

    if ($paramMap['usrCode'] == null)
        $result = Util::generateErrorJSON('Invalid parameters');
    $code = $paramMap['usrCode'];
    $usersDAO = new UsersDAO();
    $userRequested = $usersDAO->getUserByCode($code);
    if ($userRequested == null)
        $result = Util::generateErrorJSON('No such user');
    else
        $result = Util::generateOKJSON($userRequested);
} else $result = Util::generateErrorAuth();

echo $result;
