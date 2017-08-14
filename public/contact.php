<?php

require '../core/framework/View.php';

session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['username']) && !empty($_SESSION['username']))
{
    $view = new View("contact",  "Contact", "form");

}
else
{
    header('Location: signup.php');
}