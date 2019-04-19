<?php

require_once('DAO/UsersDAO.php');

class User
{
    public $code;
    public $username;
    public $password;
    public $createdAt;
    public $deletedAt;

    public function __construct($username, $password)
    {
        $usersDAO = new UsersDAO();

        $this->username = $username;
        $this->password = $password;

        $this->code = "USR" . ($usersDAO->getLastId() + 1);

        $dateTime = new DateTime();
        $date = $dateTime->getTimestamp();
        $this->createdAt = date('d.m.y H:i:s', $date);
    }

    public function delete()
    {
        $dateTime = new DateTime();
        $date = $dateTime->getTimestamp();
        $this->deletedAt = date('d.m.y H:i:s', $date);
    }
}