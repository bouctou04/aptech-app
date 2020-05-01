<?php


namespace Model;

require_once 'Model.php';

class Chat extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "chat";
    }

    public function insert(int $user_id, string $content) {
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(users_id, content, send_date) VALUES(:user_id, :content, NOW())");
        $req->execute(compact('user_id', 'content'));
    }
}