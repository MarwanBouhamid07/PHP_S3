
<?php

class Article {
    public $title;
    public $content;

    public function __construct ( $t, $c){
        $this->title = $t;
        $this->content = $c;
    }

    public function display() {
        return "Titre : " . $this->title . " - Contenu : " . $this->content;
    }
}
$article1 = new Article("Introduction of PHP","PHP is a programming languge of database.");


echo $article1->display();

$article2 = new Article("Programmation orientée objet","La POO facilite la modularité et la maintenance.");


echo "<br>" . $article2->display();

