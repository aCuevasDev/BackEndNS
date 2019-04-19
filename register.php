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
    if (!$dao->exists($username)) {
        $user = new User($username, $password);
        if ($dao->insertUser($user)) {
            $token = Token::generateToken($user);
            $result = Util::generateOKJSON($token);
        }else $result = Util::generateErrorJSON('error inserting user');
    } else $result = Util::generateErrorJSON('username already exists');
}
echo "rslt: " . $result;