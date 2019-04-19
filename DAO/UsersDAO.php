<?php

require_once('DAO/Connection.php');

class UsersDAO extends Connection
{
    private $table = 'users';

    public function getUser($code)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE code = '" . $code . "';";
        return $this->query($query);
    }

    public function getLastId()
    {
        $query = "SELECT MAX(id) FROM " . $this->table . ";";
        return $this->query($query);
    }

    public function insertUser(User $user)
    {
        $query = "INSERT INTO users (code,createdAt,username,passwrd) VALUES('" . $user->code . "','" . $user->createdAt . "','" . $user->username . "','" . $user->password . "');";
        $this->query($query);
        return true;
    }
}
