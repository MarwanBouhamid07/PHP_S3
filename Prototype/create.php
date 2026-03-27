<?php
require_once 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title     = $_POST["title"] ?? '';
    $categorie = $_POST["category"] ?? '';
    $content   = $_POST["content"] ?? '';

    $target_dir = "uploads/images/";

    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image_path_for_db = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $fileName = time() . '_' . basename($_FILES["image"]["name"]);
        $targetFilePath = $target_dir . $fileName;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $image_path_for_db = $targetFilePath;
        }
    }

    $database = new Database();
    $db = $database->getconnection();

    $sql = "INSERT INTO article (title, auteur, categorie, description, image_path) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    

    $stmt->execute([$title, 'Ahmed', $categorie, $content, $image_path_for_db]);
    
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Article - Marwan Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">MARWAN BLOG</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="create.php" class="active">Create an article</a>
            <a href="contact.html">Contact</a>
        </nav>
    </header>

    <main class="main-container">
        <section class="form-card">
            <h2>Create New Article</h2>
            <form action="create.php" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label>Article Title</label>
                    <input type="text" name="title" placeholder="Enter title here..." required>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <option value="technology">Technology</option>
                        <option value="design">Design</option>
                        <option value="lifestyle">Lifestyle</option>
                        <option value="travel">Travel</option>
                        <option value="news">News</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Cover Image</label>
                    <input type="file" name="image" required placehoder="Enter name of auteur">
                </div>
                <div class="form-group">
                    <label>Auteur</label>
                    <input type="text" name="auteur" class="file-input">
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" rows="12" placeholder="Write your article content here..." required></textarea>
                </div>

                <button type="submit" class="btn-publish">Publish Article</button>
            </form>
        </section>
    </main>
</body>
</html>