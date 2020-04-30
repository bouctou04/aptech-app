<?php


namespace Model;

require 'libraries/database.php';

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
        $req = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_utilisateur = :id");
        $req->execute(compact('id'));
        return $req->fetchAll();
    }

    /**
     * @return array
     */
    public function findAll() {
        $req = $this->pdo->query("SELECT * FROM {$this->table}");
        return $req->fetchAll();
    }

    public function findQuery(?string $sql) {
        $req = $this->pdo->prepare($sql);
        $req->execute(array());
    }

    /**
     * @param $id
     */
    public function delete($id) {
        $req = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $req->execute(compact('id'));
    }
}