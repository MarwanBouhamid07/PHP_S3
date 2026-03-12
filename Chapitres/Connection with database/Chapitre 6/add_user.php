<?php
require '../Chapitre 1/connection.php';

$name = htmlspecialchars(trim($_POST['name']));
$age = filter_var($_POST['emial'], FILTER_VALIDATE_EMAIL);

if (!$email) {
    die("invalide email !");
}
$sql = 'UPDATE users set name = :name , email = :email';
$stmt = $pdo->prepare();
  $stmt->execute([
    'nom' => $nom,
    'email' => $age
]);
echo "Utilisateur ajouté avec succès.";

try {
} catch (PDOException $e) {
    file_put_contents('logs/errors.log', $e->getMessage(), FILE_APPEND);
    echo "Une erreur est survenue. Contactez l’administrateur.";
}
