<?php

class Photo
{
    private $id;
    private $photo;
    private $createdAt;
    private $labels;
    private $localization;
    private $category;
    private $usrCode;
    private $description;


    public function create($code)
    {
        $this->usrCode = $code;

        $dateTime = new DateTime();
        $date = $dateTime->getTimestamp();
        $this->createdAt = date('d.m.y H:i:s', $date);
    }

    public function setPhotoData(array $data)
    {
        foreach ($data as $prop => $value) {
            $this->{$prop} = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @param mixed $labels
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;
    }

    /**
     * @return mixed
     */
    public function getLocalization()
    {
        return $this->localization;
    }

    /**
     * @param mixed $localization
     */
    public function setLocalization($localization)
    {
        $this->localization = $localization;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getUsrCode()
    {
        return $this->usrCode;
    }

    /**
     * @param mixed $usrCode
     */
    public function setUsrCode($usrCode)
    {
        $this->usrCode = $usrCode;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}