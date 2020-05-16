<?php


namespace Model;

require_once "Model.php";

class Faculty extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "faculty";
    }

    public function insert(int $school_id, string $faculty) {
        $school_id = intval($school_id);
        $faculty = htmlspecialchars($faculty);
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(school_id, faculty) VALUES(:school_id, :faculty)");
        $req->execute(compact('school_id', 'faculty'));
    }
}