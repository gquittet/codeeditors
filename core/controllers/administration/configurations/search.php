<?php
require '../../../framework/Controller.php';
require '../../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();
$userInformationCorrect = $controller->control($regex->getSearch(), $_POST['information']);
if ($userInformationCorrect)
{
    require '../../../framework/Model.php';
    $table = "configurations";
    $columns = Model::getColumns($table);
    $result = Model::getDataLike($table, htmlspecialchars($_POST['information']));
    while ($data[] = $result->fetch()[0]) {}
    if (count($data) > 0 && $data[0] != null)
    {
        $url = "Location: ../../../../public/admin.php?p=results&mode=configurations&data=" . urlencode(serialize($data));
        header($url);
    }
    else
    {
        header("Location: ../../../../public/admin.php?p=configurations&status=error");
    }
}
else
{
    header("Location: ../../../../public/admin.php?p=configurations&status=error");
}