<?php


namespace Model;

require_once 'Model.php';

class Forum extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "forum";
    }

    public function insert(int $user_id, string $subject, string $content, ?int $resolved = 0) {
        $user_id = intval($user_id);
        $subject = htmlspecialchars($subject);
        $content = htmlspecialchars(nl2br($content));
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(users_id, subject, content, pub_date, resolved) VALUES(:user_id, :subject, :content, NOW(), :resolved)");
        $req->execute(compact('user_id', 'subject', 'content', 'resolved'));
    }
}