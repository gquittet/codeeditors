<div class="row">
    <h1 class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4 text-center"><?= ucfirst(htmlspecialchars($_GET['p'])) ?></h1>
</div>
<?php
require '../core/objects/Form.php';
$form = new Form(substr(ucfirst(htmlspecialchars($_GET['p'])), 0, -1) . ' informations', 'search/' . htmlspecialchars($_GET['p']), 'true');
$form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
$regex = new Regex();
if (isset($_GET['status']) && !empty($_GET['status']))
{
    $error = htmlspecialchars($_GET['status']);
    if ($error == 'error')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br><?= substr(ucfirst(htmlspecialchars($_GET['p'])), 0, -1) ?> not found.
        </div>
        <?php
    }
}
$form->input("inputInformation", "text", "information", "Information", "255", "Enter an information about the " . substr(htmlspecialchars($_GET['p']), 0, -1), $regex->getSearch(), "Please enter a correct form.");
?>
<div class="form-group text-center">
    <input class="btn btn-primary" type="submit" value="Apply" style="width: 45%; margin-top: 3%; margin-right: 8%;">
    <a href="admin.php" name="delete" class="btn btn-default" value="Delete" style="width: 45%; margin-top: 3%;">Back</a>
</div>
<?php
$form->end();
?>