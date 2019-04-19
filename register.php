<?php
require_once('Model\User.php');
require_once('DAO\UsersDAO.php');

$paramMap = $_GET;

if ($paramMap['username'] == null ||
    $paramMap['password'] == null) {
    $arr = array('message' => 'invalid parameters');
    $result = json_encode($arr);
    // 404
} else {
    $dao = new UsersDAO();
    echo "noIf";
    $username = $paramMap['username'];
    $password = $paramMap['password'];
    echo "user" . $username . "pswrd" . $password;
//    if (!$dao->exists($username)) {
        $user = new User($username, $password);
        $queryResult = $dao->insertUser($user);
        $result = json_encode($queryResult);
//    } else {
//        $arr = array('message' => 'username already exists');
//        $result = json_encode($arr);
//    }
// 200
}
echo "rslt: " . $result;