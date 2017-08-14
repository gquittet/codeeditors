<?php

class Regex
{
    private $boolean;
    private $country;
    private $date;
    private $day;
    private $editorDescription;
    private $editorName;
    private $editorOwner;
    private $editorVersion;
    private $email;
    private $id;
    private $month;
    private $password;
    private $search;
    private $sha256;
    private $url;
    private $username;
    private $year;

    public function __construct()
    {
        $this->boolean = '^[01]{1,1}$';
        $this->country = '^([a-zA-Z\.]{2,20}[\x20]{0,1}){1,7}$';
        $this->date = '^((19[3-9]{1,1}[0-9]{1,1})|(2[0-' . date('Y')[1] . ']{1,1}[0-' . date('Y')[2] . ']{1,1}[0-' . date('Y')[3] . ']))-((0[1-9]{1,1})|(1[0-2]{1,1}))-((0[1-9]{1,1})|([1-2]{1,1}[0-9]{1,1})|(3[0-1]{1,1}))$';
        $this->day = '^[1-9]{1,1}$|^[1-2]{1,1}[0-9]{1,1}$|^[3]{1,1}[0-1]{1,1}$';
        $this->editorDescription = '^[\x20-\x7E]{1,500}$';
        $this->editorName = '^[\x20A-Za-z]{2,50}$';
        $this->editorOwner = '^[\x20-\x7E]{1,30}$';
        $this->editorVersion = '^[\.0-9a-zA-Z]{1,24}$';
        $this->email = "^([A-Za-z0-9!#$%&'*+\-/=?^_`{|}~]{1,1}[.]{0,1}[A-Za-z0-9!#$%&'*+\-/=?^_`{|}~]{0,1}){1,32}@{1,1}([a-zA-Z0-9]{1,1}[a-zA-Z0-9\-]{0,1}[a-zA-Z0-9]{0,1}[.]{0,1}[a-zA-Z0-9]{0,1}[a-zA-Z0-9\-]{0,1}[a-zA-Z0-9]{0,1}){1,37}\.[a-z]{2,5}$";
        $this->id = "^[0-9]{1,}$";
        $this->month = '^[1-9]{1,1}$|^[1-1]{1,1}[0-2]{1,1}$';
        $this->password = '^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}';
        $this->search = '^[\x20-\x7E]{1,255}$';
        $this->sha256 = '^[0-1]{1,256}$';
        $this->url = '^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$';
        $this->username = '^[\x21-\x7E]{3,30}$';
        $this->year = '^19[3-9]{1,1}[0-9]{1,1}$|^2[0-' . date('Y')[1] . ']{1,1}[0-' . date('Y')[2] . ']{1,1}[0-' . date('Y')[3] . ']{1,1}$';
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getSha256()
    {
        return $this->sha256;
    }

    /**
     * @return string
     */
    public function getBoolean()
    {
        return $this->boolean;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEditorName()
    {
        return $this->editorName;
    }

    /**
     * @return string
     */
    public function getEditorVersion()
    {
        return $this->editorVersion;
    }

    /**
     * @return string
     */
    public function getEditorOwner()
    {
        return $this->editorOwner;
    }

    /**
     * @return string
     */
    public function getEditorDescription()
    {
        return $this->editorDescription;
    }

    /**
     * @return string
     */
    public function getURL()
    {
        return $this->url;
    }

}