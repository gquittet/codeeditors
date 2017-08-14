<?php

class User
{
    private $id;
    private $login;
    private $email;
    private $password;
    private $country;
    private $active;

    public function __construct($id, $login, $email, $password, $country, $active)
    {
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
        $this->active = $active;
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getActive()
    {
        return $this->active;
    }
}