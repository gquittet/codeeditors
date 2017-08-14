<?php
require '../../framework/Controller.php';
require '../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();
$userInformationCorrect = $controller->control($regex->getSearch(), $_POST['information']);
if ($userInformationCorrect)
{
    require '../../framework/Model.php';
    $table = "editors";
    $columns = Model::getColumns($table);
    $result = Model::getDataLike($table, htmlspecialchars($_POST['information']));
    $data = array();
    while ($dataTemp = $result->fetch())
    {
            $data[] = $dataTemp[$columns[0]];
    }
    if (count($data) > 0)
    {

        $url = "Location: ../../../public/editors.php?data=" . urlencode(serialize($data));
        header($url);
    }
    else
    {
        header("Location: ../../../public/search.php?p=editors&status=error");
    }
}
else
{
    header("Location: ../../../public/search.php?p=editors&status=error");
}