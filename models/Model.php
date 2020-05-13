<?php


namespace Model;

require_once "Database.php";

abstract class Model extends Database
{
    /**
     * @var \PDO|null
     */
    protected $pdo;

    /**
     * @var
     */
    protected $table;

    /**
     * @var
     */
    protected $post_per_page = 10;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = Database::get_pdo();
    }

    /**
     * @param string|null $query
     * @return array
     */
    public function findAll(?string $query = NULL) {
        if($query) {
            $sql = "SELECT * FROM {$this->table}";
            $sql .= " ". $query;
        } else {
            $sql = "SELECT * FROM {$this->table}";
        }

        $req = $this->pdo->query($sql);

        return $req->fetchAll();
    }

    /**
     * @param int $id
     * @return array
     */
    public function find(int $id) {
        $req = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $req->execute(compact('id'));
        return $req->fetchAll();
    }

    /**
     * @param int $id
     */
    public function delete(int $id) {
        $req = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $req->execute(compact('id'));
    }

    /**
     * @param int $id
     * @return string
     */
    public function getUrl(int $id) {
        $article = $this->find($id);
        $id = $article[0]['id'];
        return $this->table. ".php?id=". $id;
    }

    /**
     * @return int
     */
    public function rowCount() {
        $req = $this->pdo->query("SELECT id FROM {$this->table}");
        return $req->rowCount();
    }

}