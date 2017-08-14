<?php
require '../core/objects/Combobox.php';
require '../core/objects/Form.php';
require '../core/objects/PageSelector.php';
require '../core/objects/World.php';
require '../core/framework/Model.php';
if (isset($_GET['editor']) && !empty($_GET['editor']) && isset($_GET['page']) && !empty($_GET['page'])) {
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
    $page = htmlspecialchars($_GET['page']);
    if ($page <= 0)
	header("Location: ../public/editors.php");
} else {
    header("Location: ../public/editors.php");
}
$regex = new Regex();
$name = $data[$columns[1]];
$_SESSION['editorId'] = $data[$columns[0]];
$_SESSION['editorName'] = $name;
?>
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="editors.php">Editors</a></li>
    <li class="active"><a href="editors.php?p=view&editor=<?= urlencode($dataSerialized); ?>&page=1"><?= $name ?></a></li>
</ul>
<div class="row">
    <div class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-4 col-md-offset-1 col-md-4 col-lg-offset-1 col-lg-4">
        <div class="row">
            <?php
            $form = new Form("$name", "#", true);
            $form->start("");
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
                <label>Owner:</label>
                <?php
                $column = $columns[3];
                $value =  $data[$column];
                ?>
                <p class="form-control-static" name="<?=$column?>"><?=$value?></p>
            </div>
	    <?php
            $column = $columns[4];
            $value =  $data[$column];
	    if (!empty($value))
	    {
	    ?>
		<div class="form-group">
                    <label>Website:</label>
		    <p class="form-control-static"><a target="_blank" class="link" href="<?=$value?>" name="<?=$column?>"><?=$value?></a></p>
		</div>
	    <?php
	    }
            ?>
	    <div class="form-group">
                <label>Description:</label>
                <?php
                $column = $columns[5];
                $value =  $data[$column];
                ?>
                <p class="form-control-static" name="<?=$column?>"><?=$value?></p>
	    </div>
	    <?php
	    if (htmlspecialchars($_SESSION['id']) == htmlspecialchars($data[$columns[7]]) || htmlspecialchars($_SESSION['username']) == 'root')
	    {
            ?>
                <div class="form-group text-center">
                    <a href="editors.php?p=update&editor=<?= urlencode(serialize($data[0])); ?>"
                       name="delete" class="btn btn-primary" value="Edit" style="width: 45%; margin-top: 3%; margin-right: 8%;">Edit</a>
                    <a href="editors.php" name="back" class="btn btn-default" value="Back" style="width: 45%; margin-top: 3%;">Back</a>
                </div>
                <div class="form-group text-center">
                    <a href="../core/controllers/editors/delete.php?delete=<?= urlencode(serialize($data[$columns[0]])); ?>"
                       name="delete" class="btn btn-danger" value="Delete" style="width: 100%;">Delete this editor</a>
                </div>
                <?php
            }
            else
            {
                ?>
                <div class="form-group text-center">
                    <a href="editors.php" class="btn btn-default" value="Back" style="width: 100%;">Back</a>
                </div>
                <?php
            }
            $form->end();
            ?>
        </div>
    </div>
    <div class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-5 col-md-offset-1 col-md-5 col-lg-offset-1 col-lg-5">
        <div class="row">
            <div class="well">
                <fieldset>
                    <legend>Actions:</legend>
                    <div class="row">
                        <a href="search.php?p=configurations" class="btn btn-primary col-xs-offset-4 col-xs-4 col-sm-offset-1 col-sm-4 col-lg-offset-3 col-lg-2">Search</a>
                        <a href="configurations.php?p=add" class="btn btn-default col-xs-offset-4 col-xs-4 col-sm-offset-2 col-sm-4 col-lg-offset-2 col-lg-2">Add</a>
                    </div>
                </fieldset>
            </div>
        </div>
        <?php
        $tableName = 'configurations';
	$resultPerPage = 3;
	$offset = $resultPerPage * ($page - 1);
        if (isset($_GET['data']) && !empty($_GET['data']))
        {
            $idList = unserialize($_GET['data']);
            $dataTemp = array();
            foreach ($idList as $key => $configurationId)
            {
                $query = "SELECT * FROM $tableName WHERE cId=:cId;";
                $params = array(":cId" => $configurationId);
                $dataTemp[] = Model::query($query, $params)->fetch();
            }
            $configurationData = array();
            foreach ($dataTemp as $tempKey => $item)
            {
                if (is_array($item)) {
                    foreach ($item as $key => $elem)
                    {
                        if (is_string($key))
                            $configurationData[$tempKey][$key] = $elem;
                    }
                }
            }
        }
        else
        {
	    $column = $columns[0];
	    $value =  $data[$column];
	    // Count elements
	    $query = "SELECT * FROM $tableName WHERE eId=:eId";
	    $params = array(":eId" => $value);
	    $result = Model::query($query, $params);
	    $configurationNumber = sizeof($result->fetchAll());
	    // Get elements
	    $query = "SELECT * FROM $tableName WHERE eId=:eId LIMIT $resultPerPage OFFSET $offset;";
            $params = array(":eId" => $value);
            $result = Model::query($query, $params);
            $configurationData = $result->fetchAll();
        }
        $columns = Model::getColumns($tableName);
        foreach ($configurationData as $key => $dataCurrent)
        {
        ?>
            <div class="row">
		<div class="panel panel-default">
                    <div class="panel-heading">
			<?= $dataCurrent[$columns[1]] ?> (added by <?= Model::getDataById('users', $dataCurrent[$columns[5]])->fetch()[1]; ?>)
                    </div>
                    <div class="panel-body">
			<?php
			$string = $dataCurrent[$columns[3]];
			$strLimit = 300;
			if (strlen($string) > $strLimit)
			{
                            $string = substr($string, 0, $strLimit);
                            $string = $string . "...";
                            echo $string;
			}
			else
			{
                            echo $string;
			}
			?>
                    </div>
                    <div class="panel-footing">
			<div class="row">
                            <a href="configurations.php?p=view&configuration=<?= urlencode(serialize($dataCurrent[$columns[0]])) ?>" class="btn btn-info col-xs-offset-4 col-xs-4 col-lg-offset-5 col-lg-2">Choose</a>
			</div>
			<br>
                    </div>
            </div>
            </div>
        <?php
        }
	$pageSelector = new PageSelector("editors.php?p=view&editor=" . urlencode($dataSerialized), 5, $resultPerPage, $configurationNumber);
	$pageSelector->setIndex($page);
	$pageSelector->render();
	?>
    </div>
</div>
