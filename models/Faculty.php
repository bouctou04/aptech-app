<?php


namespace Model;

require_once "Model.php";

class Faculty extends Model
{
    /**
     * Faculty constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = "faculty";
    }

    /**
     * @param int $school_id
     * @param string $faculty
     * @param string $level
     * @param int $amount
     */
    public function insert(int $school_id, string $faculty, string $level, int $amount) {
        $school_id = intval($school_id);
        $faculty = htmlspecialchars($faculty);
        $level = htmlspecialchars($level);
        $amount = intval($amount);
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(school_id, faculty, level, amount) VALUES(:school_id, :faculty, :level, :amount)");
        $req->execute(compact('school_id', 'faculty', 'level', 'amount'));
    }
}