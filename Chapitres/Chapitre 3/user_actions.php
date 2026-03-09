<?php
require_once '../Chapitre 1/connection.php';

try {
    $stmt = $pdo->prepare("INSERT INTO users (name, age) VALUES (:name, :age)");
    $stmt->execute([
        'name' => 'marwan',
        'age' => '19'
    ]);
    echo "succes of add user.";
    $stmt = $pdo->prepare("UPDATE users SET age = :age WHERE id = :id");
$stmt->execute([
    'age' => '18',
    'id' => 3
]);
echo "user updated.";

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute(['id' => 3]);
echo "delete users succes.";

echo $stmt->rowCount();



} catch (PDOException $e) {
    echo "error : " . $e->getMessage();
}
