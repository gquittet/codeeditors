<?php
require '../core/framework/View.php';
require '../core/objects/Token.php';
session_start();
if (isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['token']) && !empty($_GET['token']))
{
    $view = new View('reset/reset', 'User settings', 'form');
}
else
{
    if(isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['username']) && !empty($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $url = "Location: reset.php?user=" . $username . "&token=" . Token::getToken($username);
        header($url);
    }
    else
    {
        $view = new View('reset/getEmail', 'User settings', 'form');
    }
}
