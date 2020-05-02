<?php


namespace Model;

require_once 'Model.php';

class Message extends Model
{
    /**
     * Message constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = "messages";
    }

    /**
     * @param int $sender_id
     * @param int $receptor_id
     * @param string $content
     */
    public function insert(int $sender_id, int $receptor_id, string $content) {
        $sender_id = intval($sender_id);
        $receptor_id = intval($receptor_id);
        $content = htmlspecialchars(nl2br($content));
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(sender_id, receptor_id, content, send_date) VALUES(:sender_id, :receptor_id, :content, NOW())");
        $req->execute(compact('sender_id', 'receptor_id', 'content'));
    }

    /**
     * @param int $id
     * @return array
     */
    public function findReceptor(int $id) {
        $id = intval($id);
        $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE receptor_id = :id");
        $req->execute(compact('id'));
        return $req->fetchAll();
    }

    /**
     * @param int $sender_id
     * @param int $receptor_id
     * @return array
     */
    public function findAllVisible(int $sender_id, int $receptor_id) {
        $sender_id = intval($sender_id);
        $receptor_id = intval($receptor_id);
        $req = $this->pdo->prepare("SELECT * FROM {$this->table} INNER JOIN users ON users.id = messages.sender_id WHERE (sender_id = :sender_id AND receptor_id = :receptor_id) OR (sender_id = :receptor_id AND receptor_id = :sender_id) ORDER BY send_date DESC");
        $req->execute(compact('sender_id', 'receptor_id'));
        return $req->fetchAll();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getReception(int $id) {
        $req = $this->pdo->prepare("SELECT DISTINCT * FROM {$this->table} INNER JOIN users ON users.id = {$this->table}.sender_id WHERE sender_id = :id OR receptor_id = :id");
        $req->execute(compact('id'));
        return $req->fetchAll();
    }

}