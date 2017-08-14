<?php

require '../../../framework/Controller.php';
require '../../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();

$columns = array_keys($_POST);
$data = array_values($_POST);

$isUserInputCorrect = true;

$id = htmlspecialchars($data[0]);
$username = htmlspecialchars($data[1]);
$email = htmlspecialchars($data[2]);
$date = htmlspecialchars($data[3]);
$country = htmlspecialchars($data[4]);
$active = htmlspecialchars($data[5]);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getId(), $id);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getUsername(), $username);
$isUserInputCorrect = $isUserInputCorrect && filter_var($email, FILTER_VALIDATE_EMAIL);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getDate(), $date);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getCountry(), $country);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getBoolean(), $active);

if ($isUserInputCorrect) {
    require '../../../framework/Model.php';
    $tableName = 'users';
    Model::update($tableName, $data[0], $data, $columns);
    header('Location: ../../../../public/admin.php?p=users');
} else {
    header('Location: ../../../../public/admin.php?p=error');
}
