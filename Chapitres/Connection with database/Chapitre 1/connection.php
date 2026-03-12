<?php
$host = '127.0.0.1';
$dbname = 'store_db';
$username = 'root';
$password = '';

$dsn= "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $username, $password);// open a connection to db - pdo is an object.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connection is succese with database : $dbname";
} catch (PDOException $e) {
    echo "have an error in connection :" . $e->getMessage();
}
