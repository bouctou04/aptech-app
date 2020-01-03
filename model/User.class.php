<?php
require '../core/Database.class.php';
class User {

  // Create private attribute

  private $nom;
  private $prenom;
  private $mailAdress;
  private $pseudo;
  private $password;
  private $dateBirth;

  // Create a constructor function

  /**
  * [string] nom (ex : Coulibaly)
  * [string] prenom (ex : Dafé)
  * [string] mail adress (ex : bouctou04@yahoo.fr)
  * [string] pseudo (ex : bouctou04)
  * [string] password (ex : abc123456)
  * [string] date (N/A)
  **/

  public function __construct($nom, $prenom, $mailAdress, $pseudo, $password, $dateBirth) { 

    if(is_string($nom)) {
      $this->nom = $nom;
    } else {
      print('Error, last name must be a string');
    }

    if(is_string($prenom)) {
      $this->prenom = $prenom;
    }

    if(is_string($mailAdress)) {
      if(preg_match('#^[a-z0-9_.-]{2,}@[a-z0-9]+\.[a-z]{2,10}$#', $mailAdress)) {
        $this->mailAdress = $mailAdress;
      } else {
        print('Error, this adress mail is invalid (ex : bouctou04@gmail.com)');
        }
    }
    if(is_string($pseudo)) {
      $this->pseudo = $pseudo;
    } else {
      print('Error, pseudo must be a string');
    }

    if(is_string($password)) {
      $this->password = $password;
    } else {
      print('Error, password must be a string');
    }

    if(is_string($dateBirth)) {
      $this->dateBirth = $dateBirth;
    }

  }

  // Setter && Getter

  public function setNom($nom) {

    if(is_string($nom)) {
      $this->nom = $nom;
    } else {
      print('Error, name must be string');
      }

    }

    public function setPrenom($prenom) {

      if(is_string($prenom)) {
        $this->prenom = $prenom;
      } else {
        print('Error, first name must be a string');
      }

    }

    public function setMailAdress($mailAdress) {

      if(is_string($mailAdress)) {
        if(preg_match('#^[a-z0-9_.-]{2,}@[a-z0-9]+\.[a-z]{2,10}$#',$mailAdress)) {
          $this->mailAdress = $mailAdress;
        } else {
          print('Error, this adress mail is invalid (ex : bouctou04@gmail.com)');
              }
      } else {
        print('Error, mail adress must be a string');
      }

    }

    public function setPseudo($pseudo) {

      if(is_string($pseudo)) {
        $this->pseudo = $pseudo;
      } else {
        print('Error, pseudo must be a string');
      }

    }

    public function setPassword($password) {

      if(is_string($password)) {
        $this->password = $password;
      } else {
        print('Error, password must be a string');
      }

    }

    public function setDateBirth($dateBirth) {

      if(is_string($dateBirth)) {
        $this->dateBirth = $dateBirth;
      }

    }

    public function getNom() {
      return $this->nom;
    }

    public function getPrenom() {
      return $this->prenom;
    }

    public function getmailAdress() {
      return $this->mailAdress;
    }

    public function getPseudo() {
      return $this->pseudo;
    }

    public function getPassword() {
      return $this->password;
    }

    public function getDateBirth(){
      return $this->dateBirth;
    }
//la fonction connexion qui permet à un utilisateur de se connecté
  public function Connexion( $user,$pass)
    {
        if(is_string($user) and is_string($pass))
        {
           if($user==$this->pseudo and $pass==$this->password)
           {
             echo"bonjour";
           }
        }else{
         echo"imposible";
         }
     }
//la fonction inscription qui permet d'inscrir un utilisateur
 public function inscription($nom, $prenom, $mailAdress, $pseudo, $password, $dateBirth) {
    $req = $this->getPdo()->('INSERT INTO user () VALUES (?, ?, ?, ?, ?, ?)');
    $req->execute(array($this->nom, $this->prenom, $this->mailAdress, $this->pseudo, $this->password, $this->dateBirth));
    return $req;
 }

}