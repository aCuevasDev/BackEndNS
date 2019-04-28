<?php
require_once('Model/User.php');
require_once('DAO/UsersDAO.php');
require_once('Utils/Util.php');
require_once('Token.php');

$paramMap = $_GET;

if ($paramMap['username'] == null ||
    $paramMap['email'] == null ||
    $paramMap['password'] == null) {
    $result = Util::generateErrorJSON('Invalid parameters');
} else {
    $dao = new UsersDAO();
    $username = $paramMap['username'];
    $password = $paramMap['password'];
    $email = $paramMap['email'];
    if (!$dao->exists($email)) {
        $user = new User();
        $user->create($username, $password, $email);
        if ($dao->insertUser($user)) {
            $token = Token::generateToken($user);
            $result = Util::generateOKJSON($token);
        } else $result = Util::generateErrorJSON('Error inserting user');
    } else $result = Util::generateErrorJSON('Email already exists');
}
echo $result;