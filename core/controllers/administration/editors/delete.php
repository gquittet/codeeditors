<?php
require '../../../framework/Controller.php';
require '../../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();

if (isset($_GET['delete']) && !empty($_GET['delete']))
    $id = unserialize($_GET['delete']);
else
{
    header('Location: ../../../../public/index.php');
}

$correct = $controller->control($regex->getId(), $id);

if ($correct)
{
    require '../../../framework/Model.php';
    $table = 'editors';
    Model::delete($table, $id);
    header("Location: ../../../../public/admin.php?p=editors");
}
else
{
    header("Location: ../../../../public/index.php");
}