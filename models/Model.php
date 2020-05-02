<?php


namespace Model;

require '../libraries/Database.php';

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

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = \Database::get_pdo();
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

    /**
     * @param string|null $sql
     */
    public function findQuery(?string $sql) {
        $req = $this->pdo->prepare($sql);
        $req->execute(array());
    }

    /*public function update(int $id):void {
        // Modifier un élément
    } */

    /**
     * @param $id
     */
    public function delete(int $id) {
        $req = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $req->execute(compact('id'));
    }

    /**
     * @return int
     */
    public function row_count() {
        $req = $this->pdo->query("SELECT id FROM {$this->table}");
        return $req->rowCount();
    }
}