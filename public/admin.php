<?php
session_start();
require '../core/framework/View.php';
require '../core/framework/Controller.php';
if (isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['username']) && !empty($_SESSION['username']))
{
    if ($_SESSION['username'] == 'root')
    {
        if (isset($_GET['p']) && !empty($_GET['p']))
        {
            $param = htmlspecialchars($_GET['p']);
            if ($param == "users")
                $view = new View("administration/users", "Users Administration", "admin");
            else if ($param == "editors")
                $view = new View("administration/editors", "Editors Administration", "admin");
            else if ($param == "configurations")
                $view = new View("administration/configurations", "Configurations Administration", "admin");
            else if ($param == "results")
            {
               if (isset($_GET['mode']) && !empty($_GET['mode'])) {
                  $mode = htmlspecialchars($_GET['mode']);
                  if ($mode == 'users')
                      $view = new View("administration/users/results", "Users Administration", "admin");
                  else if ($mode == 'editors')
                      $view = new View("administration/editors/results", "Editors Administration", "admin");
                  else if ($mode == 'configurations')
                      $view = new View("administration/configurations/results", "Configurations Administration", "admin");
               }
            }
            else
            {
                $view = new View("administration/home", "Administration");
            }
        }
        else
        {
            $view = new View("administration/home", "Administration");
        }
    }
    else
    {
        header("Location: index.php");
    }
}
else
{
    header("Location: index.php");
}
?>