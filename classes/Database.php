<?php

class Database {

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "uas_inv";


    protected function connectDB(){
        try{

            $dataBase = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $pdo = new PDO($dataBase, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e){
            echo "Connetion Failed" . $e->getMessage();
        }
        
    }
    
}