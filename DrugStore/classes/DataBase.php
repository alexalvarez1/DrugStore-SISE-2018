<?php

class DataBase {

    private static $host = "localhost";
    private static $dbname = "farmacia";
    private static $user = "root";
    private static $password = "";

    public static function connect() {
        $options = array(PDO::MYSQL_ATTR_FOUND_ROWS => true);
        $pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$password, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        return $pdo;
    }

    public static function query($sql, $parametros = array(), $tipo = "SELECT") {
        $statement = self::connect()->prepare($sql);
        if (count($parametros) > 0) {
            for ($i = 0; $i < count($parametros); $i++) {
                $statement->bindParam($i + 1, $parametros[$i]);
            }
        }
        $statement->execute();
        switch ($tipo) {
            case "SELECT":
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                break;
            case "OBJECT":
                $data = $statement->fetchAll(PDO::FETCH_OBJ);
                break;
            case "IUD":
                $data = $statement->rowCount();
                break;
        }
        return $data;
    }

}
