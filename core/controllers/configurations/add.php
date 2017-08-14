<?php

require '../../framework/Controller.php';
require '../../objects/Regex.php';

if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['version']) && !empty($_POST['version']) && isset($_POST['configuration']) && !empty($_POST['configuration']))
{
    $name = htmlspecialchars($_POST['name']);
    $version = htmlspecialchars($_POST['version']);
    $configuration = htmlspecialchars($_POST['configuration']);
}
else
{
    header('Location: ../../../public/configurations.php?p=add');
}

$controller = new Controller();
$regex = new Regex();
$isNameCorrect = $controller->control($regex->getEditorName(), $name);
$isVersionCorrect = $controller->control($regex->getEditorVersion(), $version);
if (!$isNameCorrect)
    header('Location: ../../../public/configurations.php?p=add&error=name');
if (!$isVersionCorrect)
    header('Location: ../../../public/configurations.php?p=add&error=version');
$isUserInputCorrect = $isNameCorrect && $isVersionCorrect;

if ($isUserInputCorrect)
{
    require '../../framework/Model.php';
    $tableName = 'configurations';
    $query = "SELECT * FROM configurations WHERE eId=:eId AND cName=:confName;";
    $params = array(":eId" => $_SESSION['editorId'], ":confName" => $name);
    $data = Model::query($query, $params)->fetchAll();
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
        Model::insert($tableName, array($name, $version, $configuration, date('Y-m-d H:i:s'), $_SESSION['id'], $_SESSION['editorId']), $columns);
        header('Location: ../../../public/editors.php?p=view&editor=' . urlencode(serialize($_SESSION['editorId'])) . '&page=1');
    }
    else
    {
        header('Location: ../../../public/configurations.php?p=add&error=duplicate');
    }
}
else
{
    header('Location: ../../../public/configurations.php?p=add&error=global');
}