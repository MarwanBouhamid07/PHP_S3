<?php
require 'ArticleEncapsule.php';

$article = new Hamid();
$article->setTitre("POO en PHP");
$article->setContenu('<p>Introduction à la programmation orientée objet.</p>');
echo $article->afficher();
