<?php
require_once 'article.php';

class BlogArticle extends Article{
    private $auteur;

    public function __construct($title,$content,$auteur){
        parent::__construct($title,$content);
        $this->auteur = $auteur;

    } 

    public function display(){
        return parent::display() . "- Auteur :". $this->auteur;
    }
}

