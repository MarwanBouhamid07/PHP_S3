<?php

class Article{
    private $conn;
    private $table = 'article';

    public $id;
    public $title;
    public $description;
    public $image;
    public $date;
    public $autor;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
}
