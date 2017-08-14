<?php

require '../core/framework/View.php';

session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['username']) && !empty($_SESSION['username']))
{
    if (isset($_GET['p']) && !empty($_GET['p']))
    {
        $param = htmlspecialchars($_GET['p']);
        if ($param == "add")
            $view = new View('editors/add', 'Add editors', 'form');
        else if ($param == "view")
            $view = new View('editors/view', 'Editor View', 'form');
        else if ($param == "update")
            $view = new View('editors/update', 'Update Editor', 'form');
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