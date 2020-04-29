<?php


namespace Model;

require 'Model.php';

class User extends Model
{
    public function __construct()
    {
        $this->table = "Utilisateur";
    }

    public function login(string $username, string $password) {
        $username = htmlspecialchars($username);
        $password_hash = sha1($password);
    }
}