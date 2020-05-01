<?php


namespace Model;

require 'Model.php';

class Article extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "articles";
    }

    public function insert(int $user_id, string $subject, string $content, ?string $file = NULL): void {
        $user_id = intval($user_id);
        $subject = htmlspecialchars($subject);
        $content = htmlspecialchars(nl2br($subject));
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(users_id, subject, content, send_date, file) VALUES(:user_id, :subject, :content, NOW(), :file) ");
        $req->execute(compact('user_id', 'subject', 'content', 'file'));
    }
}