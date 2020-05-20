<?php


namespace Model;

require_once "Model.php";

class School extends Model
{
    /**
     * School constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = "school";
    }

}