<?php

    $paramMap = $request->getParsedBody();
    if ($paramMap['email'] == null ||
        $paramMap['username'] == null ||
        $paramMap['password'] == null) {
        return $response->withJson([], 404);
    }
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
