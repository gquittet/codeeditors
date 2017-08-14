<?php
require '../core/objects/Form.php';
?>
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Contact</li>
</ul>
<?php
$form = new Form("Contact", "contact", true);
$regex = new Regex();
$form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
if (isset($_GET['p']) && !empty($_GET['p']))
{
    $error = htmlspecialchars($_GET['p']);
    if ($error == 'error')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br>Message incorrect.
        </div>
        <?php
    }
}
?>
<div class="form-group">
    <label for="inputMessage">Username:</label>
    <p class="form-control-static" name="username"><?= $_SESSION['username'] ?></p>
</div>
<div class="form-group">
    <label for="inputMessage">Message: (max 500 chars)</label>
    <textarea class="form-control" name="message" id="inputMessage" cols="50" rows="10" minlength="1" maxlength="500" pattern=<?= $regex->getEditorDescription(); ?>></textarea>
</div>
<?php
$form->submit();
$form->end();
?>
