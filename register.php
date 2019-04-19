<?php
echo "preGet";
$paramMap = $_GET;
echo "postGet";
if ($paramMap['email'] == null ||
    $paramMap['username'] == null ||
    $paramMap['password'] == null) {
    echo "if";
    $json = json_encode([]);
    // 404
    echo $json;
}
echo "noIf";
$email = $paramMap['email'];
$username = $paramMap['username'];
$password = $paramMap['password'];
$user = new \API\Model\User();
$user->setUsername($paramMap['username']);
$user->setPassword($paramMap['password']);
$user->setEmail($paramMap['email']);
$dateTime = new DateTime();
$user->setCreated($dateTime->getTimestamp());
$user->save();
$json = json_encode($user);
// 200
echo $json;
