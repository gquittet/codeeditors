<?php

require '../../framework/Controller.php';
require '../../objects/Regex.php';

if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['version']) && !empty($_POST['version']) && isset($_POST['owner']) && !empty($_POST['owner']) && isset($_POST['description']) && !empty($_POST['description']))
{
    $name = htmlspecialchars($_POST['name']);
    $version = htmlspecialchars($_POST['version']);
    $owner = htmlspecialchars($_POST['owner']);
    $url = htmlspecialchars($_POST['website']);
    $description = htmlspecialchars($_POST['description']);
}
else
{
    header('Location: ../../../public/editors.php?p=add');
}

$controller = new Controller();
$regex = new Regex();
$isNameCorrect = $controller->control($regex->getEditorName(), $name);
$isVersionCorrect = $controller->control($regex->getEditorVersion(), $version);
$isOwnerCorrect = $controller->control($regex->getEditorOwner(), $owner);
//$isDescriptionCorrect = $controller->control($regex->getEditorDescription(), $description);

if (!$isNameCorrect)
                  header('Location: ../../../public/editors.php?p=add&error=name');
if (!$isVersionCorrect)
    header('Location: ../../../public/editors.php?p=add&error=version');
if (!$isOwnerCorrect)
    header('Location: ../../../public/editors.php?p=add&error=owner');
//if (!$isDescriptionCorrect)
//    header('Location: ../../../public/editors.php?p=add&error=description');
if (isset($_POST['website']) && !empty($_POST['website']))
{
    $isURLCorrect = filter_var($url, FILTER_VALIDATE_URL);
    if (!isURLCorrect)
        header('Location: ../../../public/editors.php?p=add&error=website');
    $isUserInputCorrect = $isNameCorrect && $isVersionCorrect && $isOwnerCorrect && $isURLCorrect;
}
else
    $isUserInputCorrect = $isNameCorrect && $isVersionCorrect && $isOwnerCorrect;

if ($isUserInputCorrect)
{
    require '../../framework/Model.php';
    $tableName = 'editors';
    $data = Model::getData($tableName, $name)->fetch();
    if ($data == false)
    {
        $columnsTemp = Model::getColumns($tableName);
        $columns = array();
        foreach ($columnsTemp as $key => $column)
        {
            if ($key > 0)
            {
                $columns[] = $column;
            }
        }
        Model::insert($tableName, array($name, $version, $owner, $website, $description, date('Y-m-d H:i:s'), $_SESSION['id']), $columns);
        header('Location: ../../../public/editors.php');
    }
    else
    {
        header('Location: ../../../public/editors.php?p=add&error=duplicate');
    }
}
else
{
    header('Location: ../../../public/editors.php?p=add&error=global');
}