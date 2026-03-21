<?php

require_once 'BlogArticle.php';

$article = new BlogArticle("POO in PHP","Decouvrir l'heritage.","Marwan");

echo $article->display();