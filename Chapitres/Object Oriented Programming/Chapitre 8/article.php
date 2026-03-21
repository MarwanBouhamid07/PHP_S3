<?php

class Article{
    protected $title;
    protected $content;

    public function __constract($title,$content){
        $this->title=$title;
        $this->content=$content;
    }
    public function display(){
        return "title :". $this->title . "- Content:". $this->content;
    }
}