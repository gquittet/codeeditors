<?php

class Model
{
    private static $pdo;

    public static function query($query, $params = null)
    {
        $result = self::getPDO()->prepare($query);
        $result->execute($params);
        return $result;
    }

    public static function insert($table, $values, $columns = null)
    {
        if ($columns == null)
            $columns = self::getColumns($table);
        if (count($values) != count($columns)) {
            throw new Exception("Values length and columns length must be the same!");
        } else {
            $query = "INSERT INTO $table(";
            foreach ($columns as $key => $column) {
                if ($key < count($columns) - 1)
                    $query = $query . "$column, ";
                else
                    $query = $query . "$column) VALUES(";
            }
            foreach ($values as $key => $value) {
                if ($key < count($values) - 1)
                    $query = $query . ":v$key, ";
                else
                    $query = $query . ":v$key);";
            }
            foreach ($values as $key => $value) {
                $params[":v$key"] = $value;
            }
            self::query($query, $params);
        }
    }

    public static function delete($tableDB, $id)
    {
        $columnId = self::getColumns($tableDB)[0];
        $query = "DELETE FROM $tableDB WHERE $columnId=:id;";
        $params = array(':id' => $id);
        $result = self::query($query, $params);
        return $result;
    }

    public static function update($table, $key, $values, $columns)
    {
        $query = "UPDATE $table SET";
        foreach ($columns as $cKey => $column)
        {
            if ($cKey > 0) {
                if ($cKey >= count($columns) - 1)
                {
                    $query = $query . ", $column=:v$cKey";
                    $params["v$cKey"] = $values[$cKey];
                }
                else if ($cKey == 1)
                {
                    $query = $query . " " . "$column=:v$cKey";
                    $params["v$cKey"] = $values[$cKey];
                }
                else
                {
                    $query = $query . ", $column=:v$cKey";
                    $params["v$cKey"] = $values[$cKey];

                }
            }
            else
            {
                $where = "WHERE $column=$key;";
            }
        }
        $query = $query . " " . $where;
        var_dump($query);
        self::query($query, $params);
    }

    public static function getColumns($tableDB)
    {
        $result = self::query("SHOW COLUMNS FROM $tableDB");
        while ($item = $result->fetch()) {
            $columns[] = $item['Field'];
        }
        return $columns;
    }

    public static function getDataById($tableDB, $dataDB)
    {
        $columns = self::getColumns($tableDB);
        $query = "SELECT * FROM $tableDB WHERE $columns[0] = :data";
        $params = array(":data" => $dataDB);
        $result = self::query($query, $params);
        return $result;
    }

    public static function getData($tableDB, $dataDB)
    {
        $columns = self::getColumns($tableDB);
        $query = "SELECT * FROM $tableDB WHERE ";
        foreach ($columns as $key => $item)
        {
            if ($key <= 0)
            {
                $query = $query . "$item = '$dataDB'";
            }
            else
            {
                $query = $query . " OR $item = '$dataDB'";
            }
        }
        $result = self::query($query);
        return $result;
    }

    public static function getDataLike($tableDB, $dataDB)
    {
        $columns = self::getColumns($tableDB);
        $query = "SELECT * FROM $tableDB WHERE ";
        foreach ($columns as $key => $item)
        {
            if ($key <= 0)
            {
                $query = $query . "$item = '$dataDB'";
            }
            else
            {
                $query = $query . " OR $item LIKE '$dataDB%'";
            }
        }
        $result = self::query($query);
        return $result;
    }

    public static function getPDO()
    {
        if (self::$pdo == null) {
            self::$pdo = new PDO("mysql:host=localhost;dbname=codeeditors;charset=utf8", 'root', 'zouloute', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return self::$pdo;
    }
}
