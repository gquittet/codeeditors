<?php

require '../objects/Regex.php';
require '../framework/Controller.php';

session_start();

if (isset($_POST['message']) && !empty($_POST['message']))
{
    $username = $_SESSION['username'];
    $message = htmlspecialchars($_POST['message']);
}
else
{
    header("Location: ../../public/contact.php?p=error");
}

$controller = new Controller();
$regex = new Regex();

$correct = true;
$correct = $correct && $controller->control($regex->getUsername(), $username);
$correct = $correct && $controller->control($regex->getEditorDescription(), $message);

if ($correct)
{
    require '../objects/Site.php';
    mail(Site::EMAIL, $username . ": Contact", $message);
    header('Location: ../../public/index.php');
}
else
{
    header("Location: ../../public/contact.php?p=error");
}

?>