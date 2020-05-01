<?php


namespace Model;

require '../libraries/database.php';

abstract class Model
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var
     */
    protected $table;

    public function __construct()
    {
        $this->pdo = get_pdo();
    }

    /**
     * @param $id
     * @return bool|\PDOStatement
     */
    public function find($id) {
        $req = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $req->execute(compact('id'));
        return $req->fetchAll();
    }

    /**
     * @param string|null $order
     * @return array
     */
    public function findAll(?string $query = NULL) {
        if($query != NULL) {
            $sql = "SELECT * FROM {$this->table} $query";
        } elseif ($query === NULL) {
            $sql = "SELECT * FROM {$this->table}";
        }
        $req = $this->pdo->query($sql);
        return $req->fetchAll();
    }

    public function findQuery(?string $sql) {
        $req = $this->pdo->prepare($sql);
        $req->execute(array());
    }

    /**
     * @param $id
     */
    public function delete(int $id) {
        $req = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $req->execute(compact('id'));
    }

    public function row_count() {
        $req = $this->pdo->query("SELECT id FROM {$this->table}");
        return $req->rowCount();
    }
}