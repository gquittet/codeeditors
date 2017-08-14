<?php
require '../../framework/Controller.php';
require '../../objects/Regex.php';

if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['passwordConfirmation']) && !empty($_POST['passwordConfirmation']))
{
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirmation = htmlspecialchars($_POST['passwordConfirmation']);
    if ($password == $passwordConfirmation)
    {
        $password = htmlspecialchars($_POST['password']);
    }
    else
    {
        $url = "Location: ../../../public/reset.php?user=" . $_SESSION['resetUsername'] . "&token=" . $_SESSION['resetToken'] . "error=password";
        header($url);
    }
}
else
{
    $url = "Location: ../../../public/reset.php?user=" . $_SESSION['resetUsername'] . "&token=" . $_SESSION['resetToken'] . "error=empty";
    header($url);
}

$regex = new Regex();
$controller = new Controller();
$correct = $controller->control($regex->getPassword(), $password);

if ($correct)
{
    require '../../framework/Model.php';
    require '../../objects/Token.php';
    require '../../objects/Encrypt.php';
    $query = "UPDATE users SET uPassword=:password WHERE uLogin=:login";
    $params = array(":password" => Encrypt::hash($password), ":login" => $_SESSION['resetUsername']);
    $username = Model::query($query, $params);
    $_SESSION['resetUsername'] = "";
    $_SESSION['resetToken'] = "";
    header("Location: ../../../public/index.php");
}
else
{
    header("Location: ../../../public/reset.php?error=email");
}

?>