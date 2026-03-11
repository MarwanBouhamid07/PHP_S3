<?php
require '../Chapitre 1/connection.php';

$stmt = $pdo->prepare("INSERT INTO users (name, age) VALUES (:name, :age)");
$stmt->execute([
    'name' => 'Mouhamed',
    'age' => 40
]);
echo "add usrs is succes.";


$name = 'Ahmed';
$age = 25;
$stmt = $pdo->prepare("INSERT INTO users (name, age) VALUES (:name, :age)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':age', $age);
$stmt->execute();

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([1]);


