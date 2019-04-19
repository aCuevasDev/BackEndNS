<?php
echo "preGet";
$paramMap = $_GET;
echo "postGet";
if ($paramMap['email'] == null ||
    $paramMap['username'] == null ||
    $paramMap['password'] == null) {
    echo "if";
    return $response->withJson([], 404);
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
echo $response->withJson($user, 200);
