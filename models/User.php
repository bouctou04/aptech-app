<?php


namespace Model;

require 'Model.php';

class User extends Model
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $first_name;

    /**
     * @var string
     */
    private string $last_name;

    /**
     * @var int
     */
    private int $category_id;

    /**
     * @var int
     */
    private int $school_id;

    /**
     * @var string
     */
    private string $birth_date;

    /**
     * @var string
     */
    private string $sexe;

    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $password;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "users";
        parent::__construct();
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $username, string $password) {
        $username = htmlspecialchars($username);
        $password = sha1($password);
        $req = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE username = :username AND password = :password");
        $req->execute(compact('username', 'password'));
        $user = $req->rowCount();
        if($user === 1) {
            $user_info = $req->fetch();
            // Hydration
            $this->setId($user_info['id']);
            $this->setLastName($user_info['last_name']);
            $this->setFirstName($user_info['first_name']);
            $this->setCategotyId($user_info['user_category_id']);
            $this->setSchoolId($user_info['school_id']);
            $this->setBirthDate($user_info['birth_date']);
            $this->setSexe($user_info['sexe']);
            $this->setUsername($user_info['username']);
            $this->setEmail($user_info['email']);
            $this->setPassword($user_info['password']);
            return true;
        } else {
            return false;
        }

    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName() {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * @return int
     */
    public function getCategoryId() {
        return $this->category_id;
    }

    /**
     * @return int
     */
    public function getSchoolId() {
        return $this->school_id;
    }

    /**
     * @return string
     */
    public function getBirthDate() {
        return $this->birth_date;
    }

    /**
     * @return string
     */
    public function getSexe() {
        return $this->sexe;
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param int $id
     */
    public function setId(int $id) {
        $this->id = $id;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name) {
        $this->last_name = $last_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name):void {
        $this->first_name = $first_name;
    }

    /**
     * @param int $category_id
     */
    public function setCategotyId(int $category_id) {
        $this->category_id = $category_id;
    }

    /**
     * @param int $school_id
     */
    public function setSchoolId(int $school_id) {
        $this->school_id = $school_id;
    }

    /**
     * @param string $birth_day
     */
    public function setBirthDate(string $birth_date) {
        $this->birth_date = $birth_date;
    }

    /**
     * @param string $sexe
     */
    public function setSexe(string $sexe) {
        $this->sexe = $sexe;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username) {
        $this->username = $username;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email) {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password) {
        $this->password = $password;
    }
}