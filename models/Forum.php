<?php


namespace Model;

require_once 'Model.php';

class Forum extends Model
{
    /**
     * Forum constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = "forum";
    }

    /**
     * @param int $user_id
     * @param string $subject
     * @param string $content
     * @param int|null $resolved
     */
    public function insert(int $user_id, string $subject, string $content, ?string $file = NULL, ?int $resolved = 0) {
        $user_id = intval($user_id);
        $subject = htmlspecialchars($subject);
        $content = htmlspecialchars(nl2br($content));
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(users_id, subject, content, pub_date, resolved, file) VALUES(:user_id, :subject, :content, NOW(), :resolved , :file)");
        $req->execute(compact('user_id', 'subject', 'content', 'resolved', 'file'));
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
     * @param int $id
     * @param int $resolved
     */
    public function setResolved(int $id, int $resolved) {
        $resolved = intval($resolved);
        $req = $this->pdo->prepare("UPDATE {$this->table} SET resolved = :resolved WHERE id = :id");
        $req->execute(compact('id', 'resolved'));
    }
}