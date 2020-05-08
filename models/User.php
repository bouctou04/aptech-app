<?php


namespace Model;

require_once 'Model.php';
require_once 'libraries/Mail.php';

use App\Mail;


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
     * Default password charactere generate auto
     */
    private const PASSWORD_LENGTH = 8;

    /**
     * Default min charactere able to repeat on generate password
     */
    private const PASSWORD_CHARACTER_REPEAT_MIN = self::PASSWORD_LENGTH - self::PASSWORD_LENGTH;

    /**
     * Default max charactere able to repeat on generate password
     */
    private const PASSWORD_CHARACTER_REPEAT_MAX = self::PASSWORD_LENGTH - 2;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "users";
        parent::__construct();
    }

    /**
     * @param int $user_category_id
     * @param int $school_id
     * @param string $last_name
     * @param string $first_name
     * @param string $birth_date
     * @param string $sexe
     * @param string $email
     * @throws \Exception
     */
    public function insert(int $user_category_id, int $school_id, string $last_name, string $first_name, string $birth_date, string $sexe, string $email) {
        $this->category_id = $user_category_id;
        $this->school_id = $school_id;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->birth_date = $birth_date;
        $this->sexe = $sexe;
        $this->email = $email;

        $user_category_id = intval($user_category_id);
        $school_id = intval($school_id);
        $last_name = htmlspecialchars($last_name);
        $first_name = htmlspecialchars($first_name);
        $birth_date = htmlspecialchars($birth_date);
        $sexe = htmlspecialchars($sexe);
        $email = htmlspecialchars($email);
        $username = $this->getDefaultUsername($this->first_name, $this->last_name, $this->email);
        $passwordn = self::generatePassword();
        $password = sha1($passwordn);

        $req = $this->pdo->prepare("INSERT INTO {$this->table}(user_category_id, school_id, last_name, first_name, birth_date, sexe, username, email, password) VALUES(:user_category_id, :school_id, :last_name, :first_name, :birth_date, :sexe, :username, :email, :password)");
        $req->execute(compact('user_category_id', 'school_id', 'last_name', 'first_name', 'birth_date', 'sexe', 'username', 'email', 'password'));

        // Sending mail
        $mail = new Mail();
        $message = "
                    <html>
                        <body>
                            <h1>Bravo $last_name $first_name Votre inscription sur la plateforme APTECH a bien été pris en compte</h1>
                              Vous pouvez vous connecter avec vos identifiants ci dessous <br> Email: $email <br> Identifiant: $username <br> Mot de passe: $passwordn
                        </body>
                    </html>
                    ";
        $mail->sendMail("bmaiga08@gmail.com", "Votre inscription sur APTECHAPP.com a bien été pris en compte !", $message);
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $username, string $password) {
        $username = htmlspecialchars($username);
        $password = sha1($password);
        $req = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE (username = :username OR email = :username) AND password = :password");
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
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @return string
     */
    public function getDefaultUsername(string $first_name, string $last_name, string $email):string {
        $username = explode("@", $email);
        $username = $username[0];
        $username = $username. "@_". $last_name.$first_name;
        return $username;
    }

    /**
     * @param string $username
     * @return bool
     */
    public function verifyUsername(string $username):bool {
        $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE username = :username");
        $req->execute(compact('username'));
        if($req->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $email
     * @return bool
     */
    public function verifyEmail(string $email):bool {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE email = :email");
            $req->execute(compact('email'));
            if($req->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @return false|string
     * @throws \Exception
     */
    public static function generatePassword() {
        $letterUpper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $letterLower = strtolower($letterUpper);
        $integer = "0123456789";
        $password = $letterUpper. $letterLower. $integer;
        return substr(str_repeat(str_shuffle($password), random_int(self::PASSWORD_CHARACTER_REPEAT_MIN, self::PASSWORD_CHARACTER_REPEAT_MAX)), 0, self::PASSWORD_LENGTH);
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