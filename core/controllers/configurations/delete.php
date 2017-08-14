<?php
require '../../framework/Controller.php';
require '../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();

if (isset($_GET['delete']) && !empty($_GET['delete']))
    $id = unserialize($_GET['delete']);
else
{
    header('Location: ../../../public/index.php');
}

$correct = $controller->control($regex->getId(), $id);

if ($correct)
{
    require '../../framework/Model.php';
    $table = 'configurations';
    Model::delete($table, $id);
    header("Location: ../../../public/editors.php?p=view&editor=" . urlencode(serialize($_SESSION['editorId'])));
}
else
{
    header("Location: ../../../public/index.php");
}