<?php

require '../../../framework/Controller.php';
require '../../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();

$columns = array_keys($_POST);
$data = array_values($_POST);

$isUserInputCorrect = true;

$id = htmlspecialchars($data[0]);
$name = htmlspecialchars($data[1]);
$version = htmlspecialchars($data[2]);
$owner = htmlspecialchars($data[3]);
$url = htmlspecialchars($data[4]);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getId(), $id);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorName(), $name);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorVersion(), $version);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorOwner(), $owner);
$isUserInputCorrect = $isUserInputCorrect && filter_var($url, FILTER_VALIDATE_URL);

if ($isUserInputCorrect) {
    require '../../../framework/Model.php';
    $tableName = 'editors';
    Model::update($tableName, $data[0], $data, $columns);
    header('Location: ../../../../public/admin.php?p=editors');
} else {
    header('Location: ../../../../public/admin.php?p=error');
}
