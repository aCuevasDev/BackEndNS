<?php
require_once('Model\User.php');
require_once('DAO\UsersDAO.php');

$paramMap = $_GET;

if ($paramMap['username'] == null ||
    $paramMap['password'] == null) {
    echo "if";
    $json = json_encode([]);
    // 404
} else {
    echo "noIf";
    $username = $paramMap['username'];
    $password = $paramMap['password'];
    echo "user" .$username ."pswrd" .$password;
    $user = new User($username,$password);

    $dao = new UsersDAO();
    $result = $dao->insertUser($user);
    $json = json_encode($result);
// 200
}
echo $json;