<?php

require_once 'BlogArticle.php';

$article = new BlogArticle("POO in PHP","Decouvrir l'heritage.","mouhamed");

echo $article->display();