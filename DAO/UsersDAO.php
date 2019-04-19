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

    public function exists($username){
        echo "username exists: " .$username;
        $query = "SELECT * FROM " .$this->table ." WHERE username = '" .$username ."';";
        return $this->query($query)->fetch_assoc();
    }

    public function getLastId()
    {
        $this->connect();
        $query = "SELECT MAX(id) FROM " . $this->table . ";";
        $result = $this->query($query)->fetch_assoc()['MAX(id)'];
        $this->disconnect();
        return ($result != null) ? $result : 1;
    }

    public function insertUser(User $user)
    {
        $this->connect();

        $query = "INSERT INTO users (code,createdAt,username,passwrd) VALUES('" . $user->code . "','" . $user->createdAt . "','" . $user->username . "','" . $user->password . "');";
        if ($this->query($query))
        return true;
        else return $this->dbError();

        $this->disconnect();
    }
}
