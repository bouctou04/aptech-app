<?php


namespace Model;

require_once 'Model.php';

class Comment extends Model
{
    public function __construct()
    {
        $this->table = "comments";
    }
}