<?php
$host = '127.0.0.1';
$dbname = 'store_db';
$username = 'root';
$password = '';

$dsn= "mysql:host=$host;dbname=$dbname;charset=utf8";
try {
    $pdo = new PDO($dsn,$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "succes connection <br>";
    } catch (PDOException $e) {
        echo "have error in connection " . $e->getMessage();
        }
        try {
            $pdo->query("SELECT * FROM user");
            echo " succes connection";
} catch (PDOException $e) {
    file_put_contents('error.log', $e->getMessage(), FILE_APPEND);
    echo "error: " . $e->getMessage();
}
