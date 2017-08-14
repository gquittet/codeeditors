<?php
require '../../framework/Controller.php';
require '../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();
$userInformationCorrect = $controller->control($regex->getSearch(), $_POST['information']);
if ($userInformationCorrect)
{
    require '../../framework/Model.php';
    $table = "configurations";
    $columns = Model::getColumns($table);
    $result = Model::getDataLike($table, htmlspecialchars($_POST['information']));
    $data = array();
    while ($dataTemp = $result->fetch())
    {
        if ($dataTemp[$columns[6]] == $_SESSION['editorId'])
            $data[] = $dataTemp[$columns[0]];
    }
    if (count($data) > 0)
    {
        $url = "Location: ../../../public/editors.php?p=view&editor=" . urlencode(serialize($_SESSION['editorId'])) . "&data=" . urlencode(serialize($data)) . "&page=1";
        header($url);
    }
    else
    {
        header("Location: ../../../public/search.php?p=configurations&status=error");
    }
}
else
{
    header("Location: ../../../public/search.php?p=configurations&status=error");
}