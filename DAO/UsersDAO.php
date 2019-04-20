<?php

require_once('DAO/Connection.php');
require_once('Model/User.php');

class UsersDAO extends Connection
{
    private $table = 'users';

    public function getUserByEmail($email)
    {
        $this->connect();
        $query = "SELECT * FROM " . $this->table . " WHERE email = '" . $email . "';";
        $result = $this->query($query)->fetch_object('User');
        $this->disconnect();
        return $result;
    }

    public function getUserByCode($code)
    {
        $this->connect();
        $query = "SELECT * FROM " . $this->table . " WHERE code = '" . $code . "';";
        $result = $this->query($query)->fetch_object('User');
        $this->disconnect();
        return $result;

    }

    public function exists($email)
    {
        $this->connect();
        $query = "SELECT * FROM " . $this->table . " WHERE email = '" . $email . "';";
        $result = $this->query($query)->fetch_object();
        $this->disconnect();
        return $result != null;
    }

    public function getLastId()
    {
        $this->connect();
        $query = "SELECT MAX(id) FROM " . $this->table . ";";
        $result = $this->query($query)->fetch_assoc()['MAX(id)'];
        $this->disconnect();
        return ($result != null) ? $result : 0;
    }

    public function insertUser(User $user)
    {
        $this->connect();
        $query = "INSERT INTO " .$this->table ." (code,createdAt,username,password,email) VALUES('" . $user->getCode() . "','" . $user->getCreatedAt() . "','" . $user->getUsername() . "','" . $user->getPassword() . "','" . $user->getEmail() . "');";
        $result = $this->query($query);
        if ($result) {
            $this->disconnect();
            return true;
        } else {
            $this->disconnect();
            return false;
        }
    }
}
