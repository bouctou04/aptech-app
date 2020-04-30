<?php


namespace Model;

require 'Model.php';

class User extends Model
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $birth_date;
    protected $sexe;
    protected $username;
    protected $email;
    protected $password;
    protected $telephone;

    public function __construct()
    {
        $this->table = "users";
        $this->pdo = get_pdo();
    }

    public function login(string $username, string $password) {
        $username = htmlspecialchars($username);
        $password_hash = sha1($password);
        $req = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE username = :username AND password = :password");
        $req->execute(compact('username', 'password'));
        $user = $req->rowCount();
        if($user === 1) {
            $user_info = $req->fetch();
            $_SESSION['id'] = $user_info['id'];
            $_SESSION['last_name'] = $user_info['last_name'];
            $_SESSION['first_name'] = $user_info['first_name'];
            $_SESSION['sexe'] = $user_info['sexe'];
            $_SESSION['username'] = $user_info['username'];
            return true;
        } else {
            return false;
        }

    }
}