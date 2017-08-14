<?php

require '../../framework/Model.php';

class Login extends Model
{
    // FUNCTIONS
    public static function getCredential($email, $password)
    {
        $result = parent::query("select * from users where uEmail=:email and uPassword=:password and uActive=:status", array(':email' => $email, ':password' => $password, ':status' => 1));
        if (count($result) > 0)
        {
            return $result;
        }
    }
}