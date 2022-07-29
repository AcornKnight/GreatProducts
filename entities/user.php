<?php
// Noah Gestiehr
// NKU - CSC299 - Summer 2022
// Class file for the user object

class User
{
    public $id;
    public $name;
    public $email;
    public $street;
    public $city;
    public $state;
    public $zip;
    public $password;

    /**
     * user constructor.
     * @param $name
     * @param $email
     * @param $street
     * @param $city
     * @param $state
     * @param $zip
     * @param $password
     */
    public function __construct($name, $email, $street, $city, $state, $zip, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }
    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
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
    public $admin = false;

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * @param boolean
     */
    public function setAdmin($admin = false)
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getOrders()
    {
        //TODO: Update to return orders once implemented
        return null;
    }
}