<?php

class Database {

    public static function connect(){

        $host = "localhost";
        $dbname = "gearSystem";
        $user = "root";
        $pass = "root";

        try{
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e){
            die("Erro na conexão: " . $e->getMessage());
        }
    }


}



?>