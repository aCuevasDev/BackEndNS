<?php

class Connection
{
    private $connection;
    private $host = 'localhost:3306';
    private $user = 'root';
    private $pass = '1234';
    private $db = 'NS';

    public function __construct()
    {
//        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db)
//        or die("Failed to connect to MySQL: " . mysqli_error());
    }

    public function query($sql)
    {
        $this->connect();
        $query = mysqli_query($this->connection,$sql);
        $result = mysqli_fetch_assoc($query);
        $this->disconnect();
        return $result;
    }

    //Funciones basicas conectar/desconectar.
    private function connect() {
        $this->connection = mysqli_connect($this->host, $this->user, $this->pass,$this->db) or die("No se ha podido establecer la conexión con el servidor");
    }
    private function disconnect() {
        mysqli_close($this->connection);
    }

}
