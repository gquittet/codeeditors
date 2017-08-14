<?php

require '../../framework/Controller.php';
require '../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();

$columns = array_keys($_POST);
$data = array_values($_POST);

$isUserInputCorrect = true;

$username = htmlspecialchars($_POST["$columns[0]"]);
$email = htmlspecialchars($_POST["$columns[1]"]);
$date = htmlspecialchars($_POST["$columns[2]"]);
$country = htmlspecialchars($_POST["$columns[3]"]);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getUsername(), $username);
$isUserInputCorrect = $isUserInputCorrect && filter_var($email, FILTER_VALIDATE_EMAIL);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getDate(), $date);
$isUserInputCorrect = $isUserInputCorrect && $controller->control($regex->getCountry(), $country);

if ($isUserInputCorrect) {
    require '../../framework/Model.php';
    $tableName = 'users';
    array_unshift($data, $_SESSION['id']);
    array_unshift($columns, Model::getColumns($tableName)[0]);
    $query = "SELECT uLogin FROM users WHERE uLogin NOT IN (SELECT uLogin FROM users WHERE uId=:id) AND uLogin=:username;";
    $params = array(':username' => $username, ':id' => $_SESSION['id']);
    if (Model::query($query, $params)->fetch() <= 0)
    {
        $query = "SELECT uEmail FROM users WHERE uEmail NOT IN (SELECT uEmail FROM users WHERE uId=:id) AND uEmail=:email;";
        $params = array(':email' => $email, ':id' => $_SESSION['id']);
        if (Model::query($query, $params)->fetch() <= 0)
        {
            Model::update($tableName, $data[0], $data, $columns);
            $_SESSION['username'] = $data[1];
            header('Location: ../../../public/settings.php?p=users');
        }
        else
        {
            header('Location: ../../../public/settings.php?p=users&emailError=duplicate');
        }
    }
    else
    {
        $query = "SELECT uEmail FROM users WHERE uEmail NOT IN (SELECT uEmail FROM users WHERE uId=:id) AND uEmail=:email;";
        $params = array(':email' => $email, ':id' => $_SESSION['id']);
        if (Model::query($query, $params)->fetch() <= 0)
        {
            header('Location: ../../../public/settings.php?p=users&usernameError=duplicate');
        }
        else
        {
            header('Location: ../../../public/settings.php?p=users&usernameError=duplicate&emailError=duplicate');
        }

    }

} else {
    header('Location: ../../../public/settings.php?p=users&error=global');
}
