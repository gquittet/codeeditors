<?php
require '../core/objects/Form.php';
require '../core/objects/World.php';
require '../core/objects/Combobox.php';
require '../core/framework/Model.php';
$regex = new Regex();
$world = new World();
$columns = Model::getColumns('users');
$data = Model::getData('users', $_SESSION['username']);
?>
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Settings</li>
</ul>
<?php
foreach ($data as $dataKey => $item) {
    $name = $item[$columns[1]];
    $form = new Form("$name", "users/update", true);
    $form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
    if (isset($_GET['emailError']) && !empty($_GET['emailError']))
    {
        $emailError = htmlspecialchars($_GET['emailError']);
        if ($emailError == 'duplicate')
        {
            ?>
            <div class="alert alert-danger">
                <strong>Error</strong><br>The email address is already attached to an existing account.
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
    if (isset($_GET['error']) && !empty($_GET['error']))
    {
        $error = htmlspecialchars($_GET['error']);
        if ($error == 'error')
        {
            ?>
            <div class="alert alert-danger">
                <strong>Error</strong><br>Please fill the fields correctly.
            </div>
            <?php
        }
    }
    ?>
    <div class="form-group">
        <label>Username</label>
        <?php
        $column = $columns[1];
        $value =  $item[$columns[1]];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" type="text" maxlength="30" placeholder="<?=$value?>" pattern="<?=$regex->getUsername()?>" title="Enter the username correctly.">
    </div>
    <div class="form-group">
        <label>Email</label>
        <?php
        $column = $columns[2];
        $value =  $item[$columns[2]];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" type="text" maxlength="255" placeholder="<?=$value?>" pattern="<?=$regex->getEmail()?>" title="Enter the email correctly.">
    </div>
    <div class="form-group">
        <label>Password</label>
        <a href="reset.php" class="form-control btn btn-primary">Reset</a>
    </div>
    <div class="form-group">
        <label>Date</label>
        <?php
        $column = $columns[4];
        $value =  $item[$columns[4]];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" type="text" maxlength="10" placeholder="<?=$value?>" pattern="<?=$regex->getDate()?>" title="Enter the date correctly.">
    </div>
    <?php
    $column = $columns[5];
    $value =  $item[$columns[5]];
    $box = new Combobox("inputCountry", "$column", "Country", $world->getCountries(), $value);
    $box->show();
    ?>
    <div class="form-group text-center">
        <input class="btn btn-primary" type="submit" value="Apply" style="width: 45%; margin-top: 3%; margin-right: 8%;">
        <a href="index.php" name="back" class="btn btn-default" value="Back" style="width: 45%; margin-top: 3%;">Back</a>
    </div>
    <div class="form-group text-center">
        <a href="../core/controllers/users/delete.php?delete=<?= urlencode(serialize($item[0])); ?>"
           name="delete" class="btn btn-danger" value="Delete" style="width: 100%;">Delete your account</a>
    </div>
    <?php
    $form->end();
}
?>
