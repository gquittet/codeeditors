<?php
require '../core/objects/Form.php';
require '../core/objects/World.php';
require '../core/objects/Combobox.php';
require '../core/framework/Model.php';
if (isset($_GET['configuration']) && !empty($_GET['configuration'])) {
    $dataSerialized = $_GET['configuration'];
    $tableName = 'configurations';
    $id = unserialize($dataSerialized);
    $query = "SELECT * FROM $tableName WHERE cId=:cId;";
    $params = array(":cId" => $id);
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
    <li><a href="editors.php?p=view&editor=<?= urlencode(serialize($_SESSION['editorId'])); ?>&page=1"><?= $_SESSION['editorName'] ?></a></li>
    <li class="active"><?= $name ?></li>
</ul>
<?php
$form = new Form("$name", "#", true);
$form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
?>
<div class="form-group">
    <label>Name:</label>
    <?php
    $column = $columns[1];
    $value =  $data[$column];
    ?>
    <p class="form-control-static" name="<?=$column?>"><?=$value?></p>
</div>
<div class="form-group">
    <label>Version:</label>
    <?php
    $column = $columns[2];
    $value =  $data[$column];
    ?>
    <p class="form-control-static" name="<?=$column?>"><?=$value?></p>
</div>
<div class="form-group">
    <label for="inputConfiguration">Configuration:</label>
    <?php
    $column = $columns[3];
    $value =  $data[$column];
    ?>
    <textarea class="form-control" name="<?=$column?>" id="inputConfiguration" cols="50" rows="10" readonly><?=$value?></textarea>
</div>
<?php
if (htmlspecialchars($_SESSION['id']) == htmlspecialchars($data[$columns[5]]) || htmlspecialchars($_SESSION['username']) == 'root')
{
    ?>
    <div class="form-group text-center">
        <a href="configurations.php?p=update&configuration=<?= urlencode(serialize($data[$columns[0]])); ?>"
           name="delete" class="btn btn-primary" value="Edit" style="width: 45%; margin-top: 3%; margin-right: 8%;">Edit</a>
        <a href="editors.php?p=view&editor=<?= urlencode(serialize($_SESSION['editorId'])); ?>&page=1" name="back" class="btn btn-default" value="Back" style="width: 45%; margin-top: 3%;">Back</a>
    </div>
    <div class="form-group text-center">
        <a href="../core/controllers/configurations/delete.php?delete=<?= urlencode(serialize($data[$columns[0]])); ?>"
           name="delete" class="btn btn-danger" value="Delete" style="width: 100%;">Delete this configuration</a>
    </div>
    <?php
}
else
{
    ?>
    <div class="form-group text-center">
        <a href="editors.php?p=view&editor=<?= urlencode(serialize($_SESSION['editorId'])) ?>&page=1" name="back" class="btn btn-default" value="Back" style="width: 100%;">Back</a>
    </div>
    <?php
}
$form->end();
?>
