<?php


namespace Model;

require_once "Model.php";

class Payment extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "payment";
    }

    public function insert(int $users_id, int $faculty_id, int $amount, ?string $type = NULL) {
        $users_id = intval($users_id);
        $faculty_id = intval($faculty_id);
        $amount = intval($amount);
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(users_id, faculty_id, amount, payment_date, type) VALUES(:users_id, :faculty_id, :amount, NOW(), :type)");
        $req->execute(compact('users_id', 'faculty_id', 'amount', 'type'));
    }

    public function sumPayment(int $users_id) {
        $req = $this->pdo->prepare("SELECT SUM(amount) AS amount FROM {$this->table} WHERE users_id = :users_id");
        $req->execute(compact('users_id'));
        return $req->fetch();
    }
}