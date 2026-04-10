<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['post'];
    try {
        $stmt = $pdo->prepare("UPDATE articles SET title = :title, content = :content WHERE id = :id");
        
        $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':id'=> $id
        ]);


    } catch (PDOException $e) {
        echo "can't update the article",$e->getMessage();
    }

}

require_once "db.php";
$id = $_GET['id'] ?? null;
try {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching article: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        form { margin-bottom: 30px; border: 1px solid #ccc; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .btn-delete { color: red; text-decoration: none; }
    </style>
    
</head>
<body>
    <form method="POST">
        <div>
            <label>Title:</label><br>
            <input type="text" name="title"  value="<?php echo $article['title']?>"  required style="width: 100%;">
        </div>
        <div>
            <label>Content:</label><br>
            <textarea name="content" rows="5"  required style="width: 100%;"><?php echo $article['content']?></textarea>
        </div><br>
        <button type="submit" name="add_article">Update</button>
    </form>
</body>
</html>