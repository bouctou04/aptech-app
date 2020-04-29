<?php


namespace Model;

require 'libraries/database.php';

class Model
{
    /**
     * @var
     */
    protected $table;

    /**
     * @param $id
     * @return bool|\PDOStatement
     */
    public function find($id) {
        $req = get_pdo()->prepare("SELECT * FROM {$this->table} WHERE id_utilisateur = :id");
        $req->execute(compact('id'));
        return $req->fetchAll();
    }

    /**
     * @return array
     */
    public function findAll() {
        $req = get_pdo()->query("SELECT * FROM {$this->table}");
        return $req->fetchAll();
    }

    /**
     * @param $id
     */
    public function delete($id) {
        $req = get_pdo()->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $req->execute(compact('id'));
    }
}