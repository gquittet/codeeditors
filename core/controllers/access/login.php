<?php

require '../../framework/Controller.php';
require '../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$isEmailCorrect = filter_var($email, FILTER_VALIDATE_EMAIL);
$isPasswordCorrect = $controller->control($regex->getPassword(), $password);
$isUserInputCorrect = $controller->areControlsCorrect(array($isPasswordCorrect));

if ($isUserInputCorrect)
{
    require '../../models/Login.php';
    require '../../objects/Encrypt.php';
    $data = Login::getCredential($email, Encrypt::hash($password))->fetch();
    if ($data != false)
    {
        $_SESSION['id'] = $data['uId'];
        $_SESSION['username'] = $data['uLogin'];
        header('Location: ../../../public/index.php');
    }
    else
    {
        header('Location: ../../../public/login.php?p=error');
    }
}
else
{
    header('Location: ../../../public/login.php?p=error');
}