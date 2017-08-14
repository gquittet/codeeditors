<?php
session_start();
require '../core/framework/View.php';
if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['username']) && !empty($_SESSION['username']))
{
    $home = new View("users/profile", "Home", 'home');
}
else
{
    $home = new View("users/home", "Home", 'home');
}
