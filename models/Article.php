<?php


namespace Model;

require_once "Model.php";

class Article extends Model
{
    /**
     * Article constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = "articles";
    }

    /**
     * @param int $id
     * @param string $subject
     * @param string $content
     */
    public function update(int $id, string $subject, string $content): void
    {
        $id = intval($id);
        $subject = htmlspecialchars($subject);
        $content = htmlspecialchars(nl2br($content));
        $req = $this->pdo->prepare("UPDATE {$this->table} SET subject = :subject, content = :content WHERE id = :id");
        $req->execute(compact('id','subject', 'content'));
    }

    /**
     * @param int $user_id
     * @param string $subject
     * @param string $content
     * @param string|null $file
     */
    public function insert(int $user_id, string $subject, string $content, ?string $file = NULL): void {
        $user_id = intval($user_id);
        $subject = htmlspecialchars($subject);
        $content = htmlspecialchars(nl2br($content));
        $excerpt = substr($content, 0, 255);
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(users_id, subject, excerpt, content, send_date, file) VALUES(:user_id, :subject, :excerpt, :content, NOW(), :file) ");
        $req->execute(compact('user_id', 'subject', 'excerpt', 'content', 'file'));
    }
}