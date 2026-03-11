<?php
require '../Chapitre 1/connection.php';

$nom = htmlspecialchars(trim($_POST['nom']));
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

if (!$email) {
    die("Email invalide !");
}

  $stmt->execute([
    'nom' => $nom,
    'email' => $email
]);
echo "Utilisateur ajouté avec succès.";

try {
} catch (PDOException $e) {
    file_put_contents('logs/errors.log', $e->getMessage(), FILE_APPEND);
    echo "Une erreur est survenue. Contactez l’administrateur.";
}
