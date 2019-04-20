<?php

class PhotosDAO extends Connection
{
    private $table = 'photos';

    public function insertPhoto(Photo $photo)
    {
        $this->connect();
        $query = "INSERT INTO " . $this->table . " (photo,createdAt,labels,localization,category,code_user) VALUES('" . $photo->getPhoto() . "','" . $photo->getCreatedAt() . "','" . $photo->getLabels() . "','" . $photo->getLocalization() . "','" . $photo->getCategory() . "','" . $photo->getUsrCode() . "');";
        $result = $this->query($query);
        if ($result) {
            $this->disconnect();
            return true;
        } else {
//            $this->disconnect();
            return $this->dbError();
        }
    }
}