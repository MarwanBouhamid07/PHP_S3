<?php
require_once 'db.php';
require_once 'Article.php';

$articleManager = new Article($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);



    $target_dir = "uploads/";

    

    $image_path_for_db = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $fileName = time() . '_' . basename($_FILES["image"]["name"]);
        $targetFilePath = $target_dir . $fileName;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $image_path_for_db = $targetFilePath;
        }
    }

    
    if (!empty($title) && !empty($content) && !empty($image_path_for_db)) {
        $articleManager->add($title, $content,$image_path_for_db);
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
    <form method="POST" enctype="multipart/form-data">
        <div>
            <label>Title:</label><br>
            <input type="text" name="title" required style="width: 100%;">
        </div>
        <div>
            <label>Content:</label><br>
            <textarea name="content" rows="5" required style="width: 100%;"></textarea>
        </div>
        <label for="image">Choose Image:</label>
        <br>
        <input type="file" required name="image">
        <br>

        <button type="submit" name="add_article">Publish Article</button>
    </form>

    <hr>

    <h3>Existing Articles</h3>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>content</th>
                <th>Date Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><img src="<?= $article['image_url'] ?>" alt="<?= $article['title'] ?>" style="width:40px;height:40px;"></td>
                <td><?= $article['title'] ?></td>
                <td><?= $article['content'] ?></td>
                <td><?= $article['created_at'] ?></td>
                <td>
                    <a href="?delete=<?= $article['id'] ?>" 
                    class="btn-delete" 
                    onclick="return confirm('Are you sure?')">Delete</a>
                    <a href="update.php?id=<?php echo $article['id']; ?>">Update</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>