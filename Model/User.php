<?php

require_once('DAO/UsersDAO.php');

class User
{
    private $code;
    private $username;
    private $password;
    private $createdAt;
    private $deletedAt;
    private $email;
    private $photos;

    public function __construct()
    {
        $usersDAO = new UsersDAO();

        $this->code = "USR" . ($usersDAO->getLastId() + 1);

        $dateTime = new DateTime();
        $date = $dateTime->getTimestamp();
        $this->createdAt = date('d.m.y H:i:s', $date);
    }

    private function delete()
    {
        $dateTime = new DateTime();
        $date = $dateTime->getTimestamp();
        $this->deletedAt = date('d.m.y H:i:s', $date);
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return false|string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param false|string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param mixed $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->delete();
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}