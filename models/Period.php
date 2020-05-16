<?php


namespace Model;

require_once "Model.php";

class Period extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "period";
    }

    public function insert(int $school_id, string $period) {
        $school_id = intval($school_id);
        $period = htmlspecialchars($period);
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(school_id, period) VALUES(:school_id, :period)");
        $req->execute(compact('school_id', 'period'));
    }

}