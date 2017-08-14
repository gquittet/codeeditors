<?php
$username = htmlspecialchars($_SESSION['username']);

if (isset($_GET['p']) && !empty($_GET['p']))
{
    $error = htmlspecialchars($_GET['p']);
    if ($error == 'error')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br>Your a son of a great mother.
        </div>
        <?php
    }
}
?>
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Administration</li>
</ul>
<div class="row">
    <h1 class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4 text-center">Hello, <?= $username ?> </h1>
</div>
<div class="row">
    <h3 class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4 text-center">What do you want to do?</h3>
</div>
<div class="row">
    <a href="admin.php?p=users" class="btn btn-default col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4" style="margin-top: 1.5em;">Modify a user</a>
</div>
<div class="row">
    <a href="admin.php?p=editors" class="btn btn-default col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4" style="margin-top: 1.2em;">Modify an editor</a>
</div>
<div class="row">
    <a href="admin.php?p=configurations" class="btn btn-default col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4" style="margin-top: 1.2em;">Modify a configuration</a>
</div>

