<?php
require_once '../Chapitre 1/connection.php';

try {
    $sql = "SELECT * FROM users WHERE age >= 19";
    $stmt = $pdo->query($sql);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

    $users = $stmt->fetchAll();

    foreach ($users as $user) {
        echo "id : " . $user['id'] . " - name : " . $user['name'] . " - age : " . $user['age'] . "<br>";
    }
} catch (PDOException $e) {
    echo "error : " . $e->getMessage();
}
