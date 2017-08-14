<?php
require '../core/objects/Form.php';
require '../core/objects/World.php';
require '../core/objects/Combobox.php';
require '../core/objects/Token.php';
require '../core/framework/Model.php';
if (isset($_GET['data']) && !empty($_GET['data'])) {
    $dataSerialized = $_GET['data'];
    $idList = unserialize($dataSerialized);
    $dataTemp = array();
    $tableName = 'users';
    foreach ($idList as $key => $userId) {
        $query = "SELECT * FROM $tableName WHERE uId=:uId;";
        $params = array(":uId" => $userId);
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
    header("Location: ../../public/admin.php?p=users&status=error");
}
?>
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="admin.php">Administration</a></li>
    <li><a href="admin.php?p=users">Users</a></li>
    <li class="active">Results</li>
</ul>
<?php
$regex = new Regex();
$world = new World();
foreach ($data as $dataKey => $item) {
    $name = $item[$columns[1]];
    $form = new Form("$name", "administration/users/update", true);
    $form->start("col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4");
    if ($item[$columns[1]] == 'root')
    {
        ?>
        <div class="form-group">
            <label>ID</label>
            <?php
            $column = $columns[0];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="255" placeholder="<?=$value?>" pattern="<?=$regex->getEmail()?>" title="You cannot edit the id." readonly>
        </div>
        <div class="form-group">
            <label>Username</label>
            <?php
            $column = $columns[1];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="30" placeholder="<?=$value?>" pattern="<?=$regex->getUsername()?>" title="You cannot change the admin username." readonly>
        </div>
        <div class="form-group">
            <label>Email</label>
            <?php
            $column = $columns[2];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="255" placeholder="<?=$value?>" pattern="<?=$regex->getEmail()?>" title="Enter the email correctly.">
        </div>
        <div class="form-group">
            <label>Password</label>
            <a href="reset.php?user=<?= $item[$columns[1]] ?>&token=<?= Token::getToken($item[$columns[1]]) ?>" class="form-control btn btn-primary">Reset</a>
        </div>
        <div class="form-group">
            <label>Date</label>
            <?php
            $column = $columns[4];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="10" placeholder="<?=$value?>" pattern="<?=$regex->getDate()?>" title="Enter the date correctly.">
        </div>
        <?php
        $column = $columns[5];
        $value =  $item[$column];
        $box = new Combobox("inputCountry", "$column", "Country", $world->getCountries(), $value);
        $box->show();
        ?>
        <div class="form-group">
            <label>Active</label>
            <?php
            $column = $columns[6];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="1" placeholder="<?=$value?>" pattern="<?=$regex->getBoolean()?>" title="Admin cannot be shut off" readonly>
        </div>
        <div class="form-group text-center">
            <input class="btn btn-default" type="submit" value="Apply" style="width: 100%;">
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="form-group">
            <label>ID</label>
            <?php
            $column = $columns[0];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="255" placeholder="<?=$value?>" pattern="<?=$regex->getEmail()?>" title="You cannot edit the id." readonly>
        </div>
        <div class="form-group">
            <label>Username</label>
            <?php
            $column = $columns[1];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="30" placeholder="<?=$value?>" pattern="<?=$regex->getUsername()?>" title="Enter the username correctly.">
        </div>
        <div class="form-group">
            <label>Email</label>
            <?php
            $column = $columns[2];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="255" placeholder="<?=$value?>" pattern="<?=$regex->getEmail()?>" title="Enter the email correctly.">
        </div>
        <div class="form-group">
            <label>Password</label>
            <a href="reset.php?user=<?= $item[$columns[1]] ?>&token=<?= Token::getToken($item[$columns[1]]) ?>" class="form-control btn btn-primary">Reset</a>
        </div>
        <div class="form-group">
            <label>Date</label>
            <?php
            $column = $columns[4];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="10" placeholder="<?=$value?>" pattern="<?=$regex->getDate()?>" title="Enter the date correctly.">
        </div>
        <?php
        $column = $columns[5];
        $value =  $item[$column];
        $box = new Combobox("inputCountry", "$column", "Country", $world->getCountries(), $value);
        $box->show();
        ?>
        <div class="form-group">
            <label>Active</label>
            <?php
            $column = $columns[6];
            $value =  $item[$column];
            ?>
            <input class="form-control" name="<?=$column?>" value="<?=$value?>"type="text" maxlength="1" placeholder="<?=$value?>" pattern="<?=$regex->getBoolean()?>" title="Enter the active state correctly.">
        </div>
        <div class="form-group text-center">
            <input class="btn btn-default" type="submit" value="Apply" style="width: 45%; margin-top: 3%; margin-right: 8%;">
            <a href="../core/controllers/administration/users/delete.php?delete=<?= urlencode(serialize($item[$columns[0]])); ?>"
               name="delete" class="btn btn-danger" value="Delete" style="width: 45%; margin-top: 3%;">Delete</a>
        </div>
        <?php
    }
    $form->end();
}
?>
