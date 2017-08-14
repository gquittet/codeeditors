<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Editors</li>
</ul>
<div class="row">
    <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
        <div class="well">
            <fieldset>
                <legend>Actions:</legend>
                <div class="row">
                    <a href="search.php?p=editors" class="btn btn-primary col-xs-offset-4 col-xs-4 col-sm-offset-1 col-sm-4 col-lg-offset-3 col-lg-2">Search</a>
                    <a href="editors.php?p=add" class="btn btn-default col-xs-offset-4 col-xs-4 col-sm-offset-2 col-sm-4 col-lg-offset-2 col-lg-2">Add</a>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<?php
require '../core/framework/Model.php';
$tableName = 'editors';
if (isset($_GET['data']) && !empty($_GET['data']))
{
    $idList = unserialize($_GET['data']);
    $dataTemp = array();
    foreach ($idList as $key => $editorId)
    {
        $query = "SELECT * FROM $tableName WHERE eId=:eId;";
        $params = array(":eId" => $editorId);
        $dataTemp[] = Model::query($query, $params)->fetch();
    }
    $data = array();
    foreach ($dataTemp as $tempKey => $item)
    {
        if (is_array($item)) {
            foreach ($item as $key => $elem)
            {
                if (is_string($key))
                    $data[$tempKey][$key] = $elem;
            }
        }
    }
}
else
{
    $query = "SELECT * FROM editors";
    $columns = Model::getColumns('editors');
    $data = Model::query($query)->fetchAll();
}
$columns = Model::getColumns($tableName);
foreach ($data as $key => $dataCurrent)
{?>
    <div class="row">
        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
    <?= $dataCurrent[$columns[1]] ?> (added by <?= Model::getDataLike('users', $dataCurrent[$columns[7]])->fetch()[1]; ?>)
    </div>
    <div class="panel-body">
                    <?php
    $string = $dataCurrent[$columns[5]];
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
	<a href="editors.php?p=view&editor=<?= urlencode(serialize($dataCurrent[$columns[0]])) ?>&page=1" class="btn btn-info col-xs-offset-4 col-xs-4 col-lg-offset-5 col-lg-2">Choose</a>
    </div>
    <br>
    </div>
    </div>
    </div>
    </div>
<?php
}
?>
