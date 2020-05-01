<?php


namespace Model;

require_once 'Model.php';

class Comment extends Model
{
    public function __construct()
    {
        $this->table = "comments";
        parent::__construct();
    }

    /**
     * @param int $category_id
     * @param int $article_id
     * @return array
     */
    public function findAllBy(int $category_id, int $article_id) {
        $category_id = intval($category_id);
        $article_id = intval($article_id);
        $req = $this->pdo->prepare("SELECT comments.id, users.id, users.username, comments.comment_category_id, comments.user_id, comments.article_id, comments.content, comments.pub_date FROM {$this->table} INNER JOIN users WHERE comment_category_id = :category_id AND article_id = :article_id");
        $req->execute(compact('category_id', 'article_id'));
        return $req->fetchAll();
    }

    public function insert(int $category_id, int $user_id, int $article_id, string $content) {
        $category_id = intval($category_id);
        $user_id = intval($user_id);
        $article_id = intval($article_id);
        $content = htmlspecialchars(nl2br($content));
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(comment_category_id, user_id, article_id, content, pub_date) VALUES(:category_id, :user_id, :article_id, :content, NOW())");
        $req->execute(compact('category_id', 'user_id', 'article_id', 'content'));
    }
}