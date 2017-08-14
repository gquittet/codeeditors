<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Email verification</li>
</ul>
<div class="row">
    <h1 class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4 text-center">Email verification</h1>
</div>
<?php
require '../core/objects/Form.php';
$form = new Form("Email verification", 'reset/getEmail', 'true');
$regex = new Regex();
$form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
if (isset($_GET['error']) && !empty($_GET['error']))
{
    $error = htmlspecialchars($_GET['error']);
    if ($error == 'empty')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br>Please, enter an email address.
        </div>
        <?php
    }
    else if ($error == 'email')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br>Email not registered. To sign up go to <a class="alert-link" href="../public/signup.php">the sign up page.</a>
        </div>
        <?php
    }
}
$form->input("inputEmail", "text", "email", "Email", "255", "Enter your email address",$regex->getEmail(), "Please enter a correct email address.");
?>
<div class="form-group text-center">
    <input class="btn btn-primary" type="submit" value="Apply" style="width: 45%; margin-top: 3%; margin-right: 8%;">
    <a href="admin.php" name="delete" class="btn btn-default" value="Delete" style="width: 45%; margin-top: 3%;">Back</a>
</div>
<?php
$form->end();
?>