<?php

require '../../framework/Controller.php';
require '../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();

$columns = array_keys($_POST);
$data = array_values($_POST);
$isUserInputCorrect = true;

$editorName = htmlspecialchars($data[0]);
$editorVersion = htmlspecialchars($data[1]);
$editorOwner = htmlspecialchars($data[2]);
$editorWebsite = htmlspecialchars($data[3]);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorName(), $editorName);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorVersion(), $editorVersion);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorOwner(), $editorOwner);
if (!empty($editorWebsite))
    $isUserInputCorrect = $isUserInputCorrect && filter_var($editorWebsite, FILTER_VALIDATE_URL);

if ($isUserInputCorrect) {
    require '../../framework/Model.php';
    $tableName = 'editors';
    array_unshift($data, $_SESSION['editorId']);
    array_unshift($columns, Model::getColumns($tableName)[0]);
    Model::update($tableName, $data[0], $data, $columns);
    header('Location: ../../../public/editors.php');
} else {
    header('Location: ../../../public/editors.php?p=error');
}
