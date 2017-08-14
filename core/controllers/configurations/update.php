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
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorName(), $editorName);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getEditorVersion(), $editorVersion);

if ($isUserInputCorrect) {
    require '../../framework/Model.php';
    $tableName = 'configurations';
    array_unshift($data, $_SESSION['configurationId']);
    array_unshift($columns, Model::getColumns($tableName)[0]);
    Model::update($tableName, $data[0], $data, $columns);
    header('Location: ../../../public/configurations.php?p=view&configuration=' . urlencode(serialize($_SESSION['configurationId'])));
} else {
    header('Location: ../../../public/editors.php?p=error');
}
