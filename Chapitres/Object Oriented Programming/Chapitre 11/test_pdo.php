<?php
require 'Database.php';

$db = (new Database())->getConnection();
$stmt = $db->query("SELECT * FROM articles");

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($articles as $article) {
    echo $article['title'] . " - " . $article['auteur'] . "<br>";
}
$sql = "INSERT INTO articles (title, contenu, auteur) VALUES (:title, :contenu, :auteur)";
$stmt = $db->prepare($sql);
$stmt->execute([
    'title' => 'Nouveau post',
    'contenu' => 'Ceci est un article ajouté via PDO.',
    'auteur' => 'Admin'
]);
$stmt = $db->prepare("UPDATE articles SET auteur = :auteur WHERE id = :id");
$stmt->execute(['auteur' => 'Alice', 'id' => 1]);
$stmt = $db->prepare("DELETE FROM articles WHERE id = :id");
$stmt->execute(['id' => 2]);
