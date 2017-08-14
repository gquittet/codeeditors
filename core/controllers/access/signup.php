<?php

require '../../framework/Controller.php';
require '../../objects/Regex.php';

$controller = new Controller();
$regex = new Regex();

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$email = htmlspecialchars($_POST['email']);
$day = htmlspecialchars($_POST['day']);
$month = htmlspecialchars($_POST['month']);
$year = htmlspecialchars($_POST['year']);
$country = htmlspecialchars($_POST['country']);
$isUsernameCorrect = $controller->control($regex->getUsername(), $username);
$isPasswordCorrect = $controller->control($regex->getPassword(), $password);
$isEmailCorrect = filter_var($email, FILTER_VALIDATE_EMAIL);
$isDayCorrect = $controller->control($regex->getDay(), $day);
$isMonthCorrect = $controller->control($regex->getMonth(), $month);
$isYearCorrect = $controller->control($regex->getYear(), $year);
$isCountryCorrect = $controller->control($regex->getCountry(), $country);
$isUserInputCorrect = $controller->areControlsCorrect(array($isUsernameCorrect, $isPasswordCorrect, $isEmailCorrect, $isDayCorrect, $isMonthCorrect, $isYearCorrect, $isCountryCorrect));

if ($isUserInputCorrect)
{
    require '../../models/Login.php';
    require '../../objects/Encrypt.php';
    $query = "SELECT * FROM users WHERE uLogin=:username";
    $params = array(':username' => $username);
    if (Login::query($query, $params)->fetch() <= 0)
    {
        $query = "SELECT * FROM users WHERE uEmail=:email";
        $params = array(':email' => $email);
        if (Login::query($query, $params)->fetch() <= 0)
        {
            if ($day < 10)
            {
                $day = '0' . $day;
            }
            if ($month < 10)
            {
                $month = '0' . $month;
            }
            $date = $year . '-' . $month . '-' . $day;
            $tableName = 'users';
            $columnsTemp = Login::getColumns($tableName);
            $columns = array();
            foreach ($columnsTemp as $key => $column)
            {
                if ($key > 0)
                {
                    $columns[] = $column;
                }
            }
            Login::insert($tableName, array($username, $email, Encrypt::hash($password), $date, $country, 1), $columns);
            $data = Login::getCredential($email, Encrypt::hash($password))->fetch();
            if ($data != false)
            {
                $_SESSION['id'] = $data['uId'];
                $_SESSION['username'] = $data['uLogin'];
                header('Location: ../../../public/index.php');
            }
        }
        else
        {
            header('Location: ../../../public/signup.php?emailError=duplicate');
        }
    }
    else
    {
        $query = "SELECT * FROM users WHERE uEmail=:email";
        $params = array(':email' => $email);
        if (Model::query($query, $params)->fetch() <= 0)
        {
            header('Location: ../../../public/signup.php?usernameError=duplicate');
        }
        else
        {
            header('Location: ../../../public/signup.php?usernameError=duplicate&emailError=duplicate');
        }

    }
}
else
{
    header('Location: ../../../public/signup.php?p=error');
}