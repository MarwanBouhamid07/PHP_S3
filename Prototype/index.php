<?php
require_once 'database.php';
require_once 'articles.php';

$database = new Database();
$db = $database->getconnection();

$article = new Article($db);
$result = $article->read();
$num = $result->rowCount();

function lastThreeArticles($db){
        $sql = 'SELECT * FROM article ORDER BY date_publication DESC LIMIT 3;';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // lastThreeArticles($db);

if($num > 0){
    $articles_arr = array();
    $articles_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $article_item = array(
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'image' => $image_path,
            'date' => $date_publication,
            'autor' => $auteur,
            'categorie' => $categorie
        );
        array_push($articles_arr['data'], $article_item);
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/8f8b4a4f39.js" crossorigin="anonymous"></script>
</head>
<body>
      <header class="navbar">
        <div class="logo">MARWAN BLOG</div>
        <nav>
            <a href="index.php" class="active">Home</a>
            <a href="create.php" >Create an article</a>
            <a href="contact.html">Contact</a>
        </nav>
    </header>
<div class="wrapper">
    <main>
        <?php if($num > 0) : ?>
            <?php foreach($articles_arr['data'] as $article) : ?>
                <section>
                    <img src="<?php echo $article['image']; ?>" alt="">
                    <p class="date"><?php echo $article['date']; ?></p>
                    <p class="autor"><?php echo $article['autor']; ?></p>
                    <h3 class="title-article"><?php echo $article['title']; ?></h3>
                    <p class="description"><?php echo $article['description']; ?></p>
                    <button class="more">Read More</button>
                </section>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No articles found</p>
        <?php endif; ?>
        <div class="numbering">
            <a href="">1</a>
            <a href="">2</a>
            <a href="">3</a>
        </div>
    </main>
    <aside>
        <div class="search">
            <form method="GET">
                <label for="search">Search:</label>
                <input type="text" placeholder="search..." name="search" id="search" style="width: 80%;padding: 5px;border: 1px solid #ccc;border-radius: 4px;">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <div class="categories">
            <div class="categorie">
                <a href="">Technology</a>
                <a href="">Design</a>
                <a href="">Lifestyle</a>
                <a href="">Travel</a>
                <a href="">News</a>
            </div>
        </div>
        
            <div class="recent-posts">
  
            <?PHP 
            $data = lastThreeArticles($db);
            if (!empty($data)):
                foreach($data as $article):
            ?>
                
                <div class="lasts-post">
                    <img src="<?php echo $article['image_path'];?>" >
                    <div class="title-and-date">
                        <div class="title-RP"><?php echo $article['title'];?></div>
                        <div class="date-RP"><?php echo $article['date_publication'];?></div>
                    </div>
                </div>
                <?php endforeach; ?> 
<?php endif; ?>
            </div>
            <div class="tags">
                <a href="">Design</a>
                <a href="">Tech</a>
                <a href="">Web</a>
                <a href="">UI/UX</a>
                <a href="">Code</a>
            </div>
    </aside>
</div>
<footer>
    <div class="head-footer">
        <div class="about">
            <h2 class="title-foot">About</h2>
            <p class="description-foot">Brief description about the blog and its purpose goes here.</p>
        </div>
        <div class="links">
            <h2 class="title-foot">Quick links</h2>
            <p class="description-foot">
                <a href="">Privacy Policy</a>
                <a href="">Terms of Service</a>
                <a href="">Contact Us</a>
            </p>
        </div>
        <div class="social-media">
            <h1 class="title-foot">Follow us</h1>
            <p>
                <a href=""></a>
                <a href=""></a>
                <a href=""></a>
                <a href=""></a>
            </p>
        </div>
    </div>
    <div class="foot-footer">&copy; 2026 Blog Name. All rights reserved </div>
</footer>
</body>
</html>