<?php
require_once 'db.php';
require_once 'Article.php';

$articleManager = new Article($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    
    if (!empty($title) && !empty($content)) {
        $articleManager->add($title, $content);
    }
}

if (isset($_GET['delete'])) {
    $articleManager->delete($_GET['delete']);
    header("Location: index.php");
    exit();
}

$articles = $articleManager->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Blog Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        form { margin-bottom: 30px; border: 1px solid #ccc; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .btn-delete { color: red; text-decoration: none; }
    </style>
</head>
<body>

    <h1>Blog Administration</h1>

    <h3>Add New Article</h3>
    <form method="POST">
        <div>
            <label>Title:</label><br>
            <input type="text" name="title" required style="width: 100%;">
        </div>
        <div>
            <label>Content:</label><br>
            <textarea name="content" rows="5" required style="width: 100%;"></textarea>
        </div><br>
        <button type="submit" name="add_article">Publish Article</button>
    </form>

    <hr>

    <h3>Existing Articles</h3>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Date Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article['title'] ?></td>
                <td><?= $article['created_at'] ?></td>
                <td>
                    <a href="?delete=<?= $article['id'] ?>" 
                       class="btn-delete" 
                       onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>