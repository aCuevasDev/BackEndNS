<?php

class Connection
{
    private $connection;
    private $host = 'localhost:3306';
    private $user = 'root';
    private $pass = '1234';
    private $db = 'ns';

    public function query($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    public function connect()
    {
        $this->connection = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
    }

    public function disconnect()
    {
        mysqli_close($this->connection);
    }

    public function dbError()
    {
        return mysqli_error($this->connection);
    }

}
