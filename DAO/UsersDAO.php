<?php

require_once('DAO/Connection.php');

class UsersDAO extends Connection
{
    private $table = 'users';

    public function getUser($username)
    {
        $this->connect();
        $query = "SELECT * FROM " . $this->table . " WHERE username = '" . $username . "';";
        $result = $this->query($query)->fetch_object('User');
        $this->disconnect();
        return $result;
    }

    public function exists($username)
    {
        $this->connect();
        $query = "SELECT * FROM " . $this->table . " WHERE username = '" . $username . "';";
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
        $query = "INSERT INTO users (code,createdAt,username,password) VALUES('" . $user->getCode() . "','" . $user->getCreatedAt() . "','" . $user->getUsername() . "','" . $user->getPassword() . "');";
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
