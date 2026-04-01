<?php
class Article {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($title, $content) {
        $sql = "INSERT INTO articles (title, content) VALUES (:title, :content)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['title' => $title, 'content' => $content]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>