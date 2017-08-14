<?php

require '../core/framework/View.php';

session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['username']) && !empty($_SESSION['username']))
{
    if (isset($_GET['p']) && !empty($_GET['p']))
    {
        $param = htmlspecialchars($_GET['p']);
        if ($param == "editors")
            $view = new View('search/editors', 'Search editor(s)', 'form');
        else if ($param == "configurations")
            $view = new View('search/configurations', 'Search configuration(s)', 'form');
    }
    else
    {
        new View('editors', "Editors", 'editors');
    }

}
else
{
    header('Location: signup.php');
}