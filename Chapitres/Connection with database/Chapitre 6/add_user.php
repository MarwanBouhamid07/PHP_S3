<?php
require '../Chapitre 1/connection.php';

$name = htmlspecialchars(trim($_POST['name']));
$age = $_POST["age"];

if(gettype($age) == "integer" || $age > 0){
    die('is it not number'); 
}

function validate_numeric($age) {
    return is_numeric($age) && $age > 0;
}
$sql = 'UPDATE users set name = :name , age = :age';
$stmt = $pdo->prepare();
  $stmt->execute([
    'nom' => $nom,
    'age' => $age
]);
echo "user is add it.";

try {
} catch (PDOException $e) {
    file_put_contents('logs/error.log', $e->getMessage(), FILE_APPEND);
    echo "Have a error in server";
}
