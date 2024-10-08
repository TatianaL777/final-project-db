<?php

//для отрисовки
class Product {
    public $article;
    public $header;
    public $description;
    public $composition;
    public $weight;
    public $price;
    public $imgSrc;
    public $count;
    
    function __construct($article, $header, $description, $composition, $weight, $price, $imgSrc, $count) {
        $this->article = $article;
        $this->header = $header;
        $this->description = $description;
        $this->composition = $composition;
        $this->weight = $weight;
        $this->price = $price;
        $this->imgSrc = $imgSrc;
        $this->count = $count;

    }
}