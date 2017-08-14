<?php
require '../core/objects/Form.php';
require '../core/objects/Combobox.php';
require '../core/objects/GQArray.php';
require '../core/objects/World.php';
?>
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Sign Up</li>
</ul>
<?php
$form = new Form("Sign Up", "access/signup", true);
$form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
if (isset($_GET['emailError']) && !empty($_GET['emailError']))
{
    $emailError = htmlspecialchars($_GET['emailError']);
    if ($emailError == 'duplicate')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br>The email address is already attached to an existing account. Please, <a class="alert-link" href="../forget.php">reset your password</a> if you forgot it.
        </div>
        <?php
    }
}
if (isset($_GET['usernameError']) && !empty($_GET['usernameError']))
{
    $usernameError = htmlspecialchars($_GET['usernameError']);
    if ($usernameError == 'duplicate') {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br>The username already exists. Please choose another one.
        </div>
        <?php
    }
}
if (isset($_GET['p']) && !empty($_GET['p']))
{
    $error = htmlspecialchars($_GET['p']);
    if ($error == 'error')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br>Please fill the fields correctly.
        </div>
        <?php
    }
}
$form->input("inputUsername", "text", "username", "Username", '30', "Enter your username");
$form->inputEmail();
$form->inputPassword();
$form->groupTitle("Date of birth");
$list = new GQArray(1, 31);
$list->generateInc();
$box = new Combobox("inputDay", "day", "Day", $list->getContent(), "1");
$box->show();
$list = new GQArray(1, 12);
$list->generateInc();
$box = new Combobox("inputMonth", "month", "Month", $list->getContent(), "1");
$box->show();
$list = new GQArray(1937, date('Y'));
$list->generateDec();
$box = new Combobox("inputYear", "year", "Year", $list->getContent(), date('Y'));
$box->show();
$form->groupTitle("Localization");
$world = new World();
$box = new Combobox("inputCountry", "country", "Country", $world->getCountries(), "Belgium");
$box->show();
$form->submit();
$form->end();
?>