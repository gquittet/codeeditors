<?php
require '../core/objects/Form.php';
require '../core/objects/World.php';
require '../core/objects/Combobox.php';
require '../core/framework/Model.php';
if (isset($_GET['editor']) && !empty($_GET['editor'])) {
    $dataSerialized = $_GET['editor'];
    $tableName = 'editors';
    $id = unserialize($dataSerialized);
    if ($id >= 0)
        $query = "SELECT * FROM $tableName WHERE eId=:eId;";
    else
        header("Location: ../public/editors.php");
    $params = array(":eId" => $id);
    $data = Model::query($query, $params)->fetch();
    $columns = Model::getColumns($tableName);
} else {
    header("Location: ../../public/editors.php");
}
$regex = new Regex();
$name = $data[$columns[1]];
?>
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="editors.php">Editors</a></li>
    <li><a href="editors.php?p=view&editor=<?= urlencode(serialize($data[$columns[0]])); ?>"><?= $name ?></a></li>
    <li class="active">Edition</li>
</ul>
<?php
$form = new Form("$name", "editors/update", true);
$form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
?>
        <?php
        $column = $columns[0];
        $value =  $data[$column];
        $_SESSION['editorId'] = $value;
        ?>
    <div class="form-group">
        <label>Name:</label>
        <?php
        $column = $columns[1];
        $value =  $data[$column];
        $_SESSION['editorName'] = $value;
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" minlength="1" maxlength="30" pattern="<?= $regex->getEditorName() ?>" title="Enter a correct name.">
    </div>
    <div class="form-group">
        <label>Version:</label>
        <?php
        $column = $columns[2];
        $value =  $data[$column];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" minlength="1" maxlength="24" pattern="<?= $regex->getEditorVersion() ?>" title="Enter a correct version.">
    </div>
    <div class="form-group">
        <label>Owner:</label>
        <?php
        $column = $columns[3];
        $value =  $data[$column];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" minlength="1" maxlength="30" pattern="<?= $regex->getEditorOwner() ?>" title="Enter a correct owner's name.">
    </div>
    <div class="form-group">
        <label>Website:</label>
        <?php
        $column = $columns[4];
        $value =  $data[$column];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" minlength="0" maxlength="255" pattern="<?= $regex->getURL() ?>" title="Enter a correct URL.">
    </div>
    <div class="form-group">
        <label for="inputDescription">Description:</label>
        <?php
        $column = $columns[5];
        $value =  $data[$column];
        ?>
        <textarea class="form-control" name="<?= $column ?>" cols="50" rows="10" minlength="1" maxlength="500" pattern=<?= $regex->getEditorDescription(); ?>><?=$value?></textarea>
    </div>
    <div class="form-group text-center">
        <input type="submit" class="btn btn-primary" value="Apply" style="width: 45%; margin-top: 3%; margin-right: 8%;">
        <a href="editors.php?p=view&editor=<?= urlencode(serialize($data[$columns[0]])); ?>"
           name="back" class="btn btn-default" value="Back" style="width: 45%; margin-top: 3%;">Back</a>
    </div>
<?php
$form->end();
?>
