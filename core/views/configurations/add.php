<?php
require '../core/objects/Form.php';
$regex = new Regex();
?>
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="editors.php">Editors</a></li>
        <li><a href="editors.php?p=view&editor=<?= urlencode(serialize($_SESSION['editorId'])); ?>"><?= $_SESSION['editorName'] ?></a></li>
        <li class="active">Add Configuration for <?= $_SESSION['editorName'] ?></li>
    </ul>
<?php
$form = new Form("New configuration", "configurations/add", true);
$form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
if (isset($_GET['error']) && !empty($_GET['error']))
{
    $error = htmlspecialchars($_GET['error']);
    if ($error == 'name')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br> Enter a correct name.
        </div>
        <?php
    }
    else if ($error == 'version')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br> Enter a correct version.
        </div>
        <?php
    }
    else if ($error == 'configuration')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br> Enter a correct configuration.
        </div>
        <?php
    }
    else if ($error == 'duplicate')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br> The configuration already exist.
        </div>
        <?php
    }
    else if ($error == 'global')
    {
        ?>
        <div class="alert alert-danger">
            <strong>Error</strong><br> Enter the correct information.
        </div>
        <?php
    }
    ?>

    <?php
}

$form->input("inputName", "text", "name", "Name", "50", "Enter the name of the configuration", $regex->getEditorName(), "Please enter a correct name.");
$form->input("inputVersion", "text", "version", "Version", "24", "Enter the version of the configuration", $regex->getEditorVersion(), "Please enter a correct version.");
?>
    <div class="form-group">
        <label for="inputDescription">Configuration:</label>
        <textarea class="form-control" name="configuration" id="inputConfiguration" cols="50" rows="10" minlength="1" pattern=<?= $regex->getEditorDescription(); ?>></textarea>
    </div>
    <div class="form-group text-center">
        <input type="submit" name="submit" class="btn btn-primary" value="Submit" style="width: 45%; margin-top: 3%; margin-right: 8%;">
        <a href="editors.php" name="back" class="btn btn-default" value="Back" style="width: 45%; margin-top: 3%;">Back</a>
    </div>
<?php
$form->end();
