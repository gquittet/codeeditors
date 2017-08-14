<?php

require '../../../framework/Controller.php';
require '../../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();

$columns = array_keys($_POST);
$data = array_values($_POST);

$isUserInputCorrect = true;

$editorName = htmlspecialchars($data[1]);
$editorVersion = htmlspecialchars($data[2]);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorName(), $editorName);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorVersion(), $editorVersion);

if ($isUserInputCorrect) {
    require '../../../framework/Model.php';
    $tableName = 'configurations';
    Model::update($tableName, $data[0], $data, $columns);
    header('Location: ../../../../public/admin.php?p=configurations');
} else {
    header('Location: ../../../../public/admin.php?p=error');
}
