<?php
require '../core/objects/Form.php';
require '../core/objects/World.php';
require '../core/objects/Combobox.php';
require '../core/framework/Model.php';
if (isset($_GET['data']) && !empty($_GET['data'])) {
    $dataSerialized = $_GET['data'];
    $idList = unserialize($dataSerialized);
    $dataTemp = array();
    $tableName = 'editors';
    foreach ($idList as $key => $editorId) {
        $query = "SELECT * FROM $tableName WHERE eId=:eId;";
        $params = array(":eId" => $editorId);
        $dataTemp[] = Model::query($query, $params)->fetch();
    }
    foreach ($dataTemp as $tempKey => $item) {
        if (is_array($item)) {
            foreach ($item as $key => $elem) {
                if (is_string($key))
                    $data[$tempKey][$key] = $elem;
            }
        }
    }
    $columns = Model::getColumns($tableName);
}
else
{
    header("Location: ../../public/admin.php?p=editors&status=error");
}
?>
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="admin.php">Administration</a></li>
    <li><a href="admin.php?p=editors">Editors</a></li>
    <li class="active">Results</li>
</ul>
<?php
$regex = new Regex();
foreach ($data as $dataKey => $item) {
    $name = $item[$columns[1]];
    $form = new Form("$name", "administration/editors/update", true);
    $form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
    ?>
    <div class="form-group">
        <label>ID:</label>
        <?php
        $column = $columns[0];
        $value =  $item[$column];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" type="text" placeholder="<?=$value?>" pattern="<?=$regex->getId()?>" title="You cannot edit the id." readonly>
    </div>
    <div class="form-group">
        <label>Name:</label>
        <?php
        $column = $columns[1];
        $value =  $item[$column];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" minlength="1" maxlength="30" pattern="<?= $regex->getEditorName() ?>" title="Enter a correct name.">
    </div>
    <div class="form-group">
        <label>Version:</label>
        <?php
        $column = $columns[2];
        $value =  $item[$column];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" minlength="1" maxlength="24" pattern="<?= $regex->getEditorVersion() ?>" title="Enter a correct version.">
    </div>
    <div class="form-group">
        <label>Owner:</label>
        <?php
        $column = $columns[3];
        $value =  $item[$column];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" minlength="1" maxlength="30" pattern="<?= $regex->getEditorOwner() ?>" title="Enter a correct owner's name.">
    </div>
    <div class="form-group">
        <label>Website:</label>
        <?php
        $column = $columns[4];
        $value =  $item[$column];
        ?>
        <input class="form-control" name="<?=$column?>" value="<?=$value?>" minlength="0" maxlength="255" pattern="<?= $regex->getURL() ?>" title="Enter a correct URL.">
    </div>
        <div class="form-group">
        <label for="inputDescription">Description:</label>
        <?php
        $column = $columns[5];
        $value =  $item[$column];
        ?>
        <textarea class="form-control" name="<?= $column ?>" cols="50" rows="10" minlength="1" maxlength="500" pattern=<?= $regex->getEditorDescription(); ?>><?=$value?></textarea>
    </div>
    <div class="form-group text-center">
        <input class="btn btn-default" type="submit" value="Apply" style="width: 45%; margin-top: 3%; margin-right: 8%;">
        <a href="../core/controllers/administration/editors/delete.php?delete=<?= urlencode(serialize($item[$columns[0]])) ?>"
           name="delete" class="btn btn-danger" value="Delete" style="width: 45%; margin-top: 3%;">Delete</a>
    </div>
    <?php
$form->end();
}
?>
