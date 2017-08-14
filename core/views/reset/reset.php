<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Password resetting</li>
</ul>
<div class="row">
    <h1 class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4 text-center">New password</h1>
</div>
<?php
if (isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['token']) && !empty($_GET['token']))
{
    $username = htmlspecialchars($_GET['user']);
    $token = htmlspecialchars($_GET['token']);
}
else
{
    header("Location: reset.php");
}

if (Token::getToken($username) == $token)
{
    require '../core/objects/Form.php';
    $regex = new Regex();
    $form = new Form("New password", "reset/reset", true);
    $form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
    if (isset($_GET['error']) && !empty($_GET['error']))
    {
        $error = htmlspecialchars($_GET['error']);
        if ($error == 'empty')
        {
            ?>
            <div class="alert alert-danger">
                <strong>Error</strong><br> Please enter the password 2 times to confirm it.
            </div>
            <?php
        }
        else if ($error == 'password')
        {
            ?>
            <div class="alert alert-danger">
                <strong>Error</strong><br> The 2 password must be the same.
            </div>
            <?php
        }
    }
    $_SESSION['resetToken'] = $token;
    $_SESSION['resetUsername'] = $username;
    $passwordTitle = "Your password must containt at least 8 characters, one uppercase letter, one lowercase letter, one number and one special character.";
    $form->input("inputPassword", "password", "password", "Password", 255, "Enter the new password", $regex->getPassword(), $passwordTitle);
    $form->input("inputPasswordConfirmation", "password", "passwordConfirmation", "Password (Confirmation)", 255, "Confirm the password", $regex->getPassword(), $passwordTitle);
    $form->submit("Apply");
    $form->end();
}
else
{
    header("Location: index.php");
}