<?php

if (isset($_POST['email']) && !empty($_POST['email']))
{
    $email = htmlspecialchars($_POST['email']);
}
else
{
    header("Location: ../../../public/reset.php?error=empty");
}

$correct = filter_var($email, FILTER_VALIDATE_EMAIL);

if ($correct)
{
    require '../../framework/Model.php';
    require '../../objects/Token.php';
    $query = "SELECT uLogin FROM users WHERE uEmail=:uEmail";
    $params = array(":uEmail" => $email);
    $username = Model::query($query, $params)->fetch();
    if ($username != false)
    {
        $username = $username[0];
        $token = Token::getToken($username);
        $url = "http://localhost/cours-php/projet/site/public/reset?user=$username&token=$token";
        mail($email, "Password reset request", "Go to <a href=\"$url\">$url</a> to reset your password.");
        header('Location: ../../../public/index.php');
    }
    else
    {
        header("Location: ../../../public/reset.php?error=email");
    }
}
else
{
    header("Location: ../../../public/reset.php?error=email");
}

?>