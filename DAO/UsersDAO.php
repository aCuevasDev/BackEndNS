<?php

require_once('DAO/Connection.php');

class UsersDAO extends Connection
{
    private $table = 'users';

    public function getUser($code)
    {
        $this->connect();
        $query = "SELECT * FROM " . $this->table . " WHERE code = '" . $code . "';";
        $result = $this->query($query)->fetch_object();
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
        $query = "INSERT INTO users (code,createdAt,username,passwrd) VALUES('" . $user->code . "','" . $user->createdAt . "','" . $user->username . "','" . $user->password . "');";
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
