<?php
require '../core/objects/Form.php';
?>
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Sign In</li>
</ul>
<?php
$form = new Form("Login", "access/login", true);
$form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
if (isset($_GET['p']) && !empty($_GET['p']))
{
    $error = htmlspecialchars($_GET['p']);
    if ($error == 'error')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br>Email or password incorrect.
        </div>
        <?php
    }
}
$form->inputEmail();
$form->inputPassword();
$form->link("reset.php", "I forgot my password");
$form->submit();
$form->end();
?>
