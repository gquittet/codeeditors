<?php
require '../core/framework/View.php';

session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['username']) && !empty($_SESSION['username']))
{
    header("Location: index.php");
}
else
{
    $login = new View('access/login', 'Login', 'form');
}