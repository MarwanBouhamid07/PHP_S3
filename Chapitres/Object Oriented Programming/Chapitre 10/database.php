<?php 

class Database{
private $host = 'localhost';
private $dbname = 'store_db';
private $username = 'root';
private $password = '';
public $conn;

public function getConnection(){
    $this->conn = null;

    try{
        $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname};username={$this->username};password={$this->password}");
        $this->conn->setAttribue(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch (PDOExeption $e){
        echo 'error:'.$e->getMessage();
    }
    return $this->conn;
}
}