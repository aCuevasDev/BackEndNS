<?php
require_once('Model/User.php');
require_once('DAO/UsersDAO.php');
require_once('Utils/Util.php');
require_once('Token.php');

$paramMap = $_GET;

if ($paramMap['email'] == null ||
    $paramMap['password'] == null) {
    $result = Util::generateErrorJSON('invalid parameters');
} else {
    $dao = new UsersDAO();
    $email = $paramMap['email'];
    $password = $paramMap['password'];
    $user = $dao->getUserByEmail($email);
    if ($user == null) {
        $result = Util::generateErrorJSON('incorrect email or password');
    } else {
        if ($user->getPassword() == $password) {
            $token = Token::generateToken($user);
            $result = Util::generateOKJSON($token);
            $result = Util::generateOKJSON($token);
        } else $result = Util::generateErrorJSON('incorrect email or password');
    }
}
echo $result;