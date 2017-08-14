<?php
require '../core/framework/View.php';
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    if (isset($_GET['p']) && !empty($_GET['p']))
    {
        $param = htmlspecialchars($_GET['p']);
        if ($param == "users")
            $view = new View('users/settings', 'User settings', 'form');
    }
    else
    {
        header('Location: index.php');
    }
}
else
{
    header('Location: index.php');
}