<?php
require_once('Model\User.php');
require_once('DAO\UsersDAO.php');
require_once('Utils\Util.php');
require_once('Token.php');

$paramMap = $_GET;

if ($paramMap['username'] == null ||
    $paramMap['email'] == null ||
    $paramMap['password'] == null) {
    $result = Util::generateErrorJSON('invalid parameters');
} else {
    $dao = new UsersDAO();
    $username = $paramMap['username'];
    $password = $paramMap['password'];
    $email = $paramMap['email'];
    if (!$dao->exists($email)) {
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);
        if ($dao->insertUser($user)) {
            $token = Token::generateToken($user);
            $result = Util::generateOKJSON($token);
        } else $result = Util::generateErrorJSON('error inserting user');
    } else $result = Util::generateErrorJSON('email already exists');
}
echo $result;