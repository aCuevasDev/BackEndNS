<?php
require_once('Model\User.php');
require_once('DAO\UsersDAO.php');
require_once('Utils\Util.php');
require_once('Token.php');

$paramMap = $_GET;

if ($paramMap['username'] == null ||
    $paramMap['password'] == null) {
    $result = Util::generateErrorJSON('invalid parameters');
} else {
    $dao = new UsersDAO();
    $username = $paramMap['username'];
    $password = $paramMap['password'];
    $user = $dao->getUser($username);

    if ($user == null) {
        $result = Util::generateErrorJSON('incorrect username/password');
    } else {
        if ($user->getPassword() == $password) {
            $token = Token::generateToken($user);
            $result = Util::generateOKJSON($token);
            $result = Util::generateOKJSON($token);
        } else $result = Util::generateErrorJSON('incorrect username/password');
    }
}
echo $result;