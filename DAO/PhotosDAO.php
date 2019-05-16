<?php

require_once('Model/User.php');
require_once('Model/Photo.php');
require_once('DAO/UsersDAO.php');

class PhotosDAO extends Connection
{
    private $table = 'photos';

    public function insertPhoto(Photo $photo)
    {
        $this->connect();
        $query = "INSERT INTO " . $this->table . " (photo,createdAt,labels,description,localization,category,code_user) VALUES('" . $photo->getPhoto() . "','" . $photo->getCreatedAt() . "','" . $photo->getLabels() . "','" . $photo->getDescription() . "','" . $photo->getLocalization() . "','" . $photo->getCategory() . "','" . $photo->getUsrCode() . "');";
        $result = $this->query($query);
        if ($result) {
            $this->disconnect();
            return true;
        } else {
            $error = $this->dbError();
            $this->disconnect();
            return $error;
        }
    }

    public function getAllPhotos()
    {
        $userDao = new UsersDAO();
        $this->connect();
        $query = "SELECT * FROM " . $this->table . " ORDER BY createdAt DESC;";
        $result = [];
        $resultDB = $this->query($query);
        while ($row = mysqli_fetch_assoc($resultDB)) {
            $user = $userDao->getUserByCode($row['code_user']);
            $row['usrCode'] = $user->username;
            $row['username'] = $user->username ."a";
            var_dump($user);
            array_push($result, $row);
        }

        if ($result != null) {
            $this->disconnect();
            return $result;
        } else {
            $error = $this->dbError();
            $this->disconnect();
            return $error;
        }
    }

    public function getPhotosUser($usrCode)
    {
        $this->connect();
        $query = "SELECT * FROM " . $this->table . "  WHERE code_user = '" . $usrCode . "';";
        $result = [];
        $resultDB = $this->query($query);
        while ($row = mysqli_fetch_assoc($resultDB)) {
            array_push($result, $row);
        }
        if ($result != null) {
            $this->disconnect();
            return $result;
        } else {
            $error = $this->dbError();
            $this->disconnect();
            return $error;
        }
    }

    public function getPhoto($idPhoto)
    {
        $this->connect();
        $query = "SELECT * FROM " . $this->table . " WHERE id = '" . $idPhoto . "';";
        $result = $this->query($query)->fetch_assoc();

        if ($result != null) {
            $this->disconnect();
            return $result;
        } else {
            $error = $this->dbError();
            $this->disconnect();
            return $error;
        }
    }

    public function updatePhoto(Photo $photo)
    {
        $this->connect();
        $query = "UPDATE " . $this->table . " SET labels = '" . $photo->getLabels() . "' ,description = '" . $photo->getDescription() . "' ,localization = '" . $photo->getLocalization() . "' ,category = '" . $photo->getCategory() . "' WHERE id = '" . $photo->getId() . "';";
        $result = $this->query($query);
        if ($result) {
            $this->disconnect();
            return true;
        } else {
            $error = $this->dbError();
            $this->disconnect();
            return $error;
        }
    }

}