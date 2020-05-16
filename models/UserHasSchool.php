<?php


namespace Model;


class UserHasSchool extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "user_has_school";
    }

    public function insert(int $user_id, int $faculty_id, int $level_id, int $period_id) {
        $req = $this->pdo->prepare("INSERT INTO {$this->table}(users_id, faculty_id, level_id, period_id) VALUES(:user_id, :faculty_id, :level_id, :period_id)");
        $req->execute(compact('user_id', 'faculty_id', 'level_id', 'period_id'));
    }
}