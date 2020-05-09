<?php


namespace Controller;

require_once 'models/Article.php';
require_once 'libraries/utils.php';

class Article
{
    public function index() {
        // Show all articles
        $article = new \Model\Article();
        if(!empty($article->findAll())) {
           $articles = $article->findAll();
        } else {
            echo "Pas d'article !";
        }
        echo "Je suis super génial";
    }

    public function show() {
        //Show article
    }

    public function delete() {
        // Delete article
    }
}