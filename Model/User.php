<?php

require_once('DAO/UsersDAO.php');

class User
{
    public $code;
    public $username;
    public $password;
    public $createdAt;
    public $deletedAt;
    public $photos = [];

    public function __construct($username, $password){
        $usersDAO = new UsersDAO();

        $this->username = $username;
        $this->password = $password;

        $this->code = "USR".$usersDAO->getLastId();

        $dateTime = new DateTime();
        $this->createdAt = $dateTime->getTimestamp();
    }
}