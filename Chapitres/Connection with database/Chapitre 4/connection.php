<?php

$host = 'localhost';
$dbname = 'store_db';
$username = 'root';
$pass='';

try{

$dsn = "mysql:host=$host;dbname=$dbname";

$pdo = new PDO($dsn,$username,$pass);

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
echo "succes connection <br>";
$sqlprepare = $pdo->query('SELECT * FROM users');

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

$data = $sqlprepare->fetchAll();

echo "<br> list des utilisateur <br>";

foreach($data as $user){
    echo  "user:". $user['name'] ."<br>";
}

}catch(PDOException $e){
    file_put_contents("errors.log",$e->getMessage()."date: ".date("Y-m-d H:i:s") ."\n",FILE_APPEND);
    echo "error:". $e->getMessage();
}