<?php
require 'db.class.php';
class Login extends Database {
	private $identifiant;
	private $mot_de_passe;

	public function __construct() {
		parent::__construct();
	}

	public function login($identifiant, $mot_de_passe) {
		$this->identifiant = $identifiant;
		$this->mot_de_passe = sha1($mot_de_passe);
		$req = $this->get_pdo()->prepare('SELECT * FROM Utilisateur WHERE (nom_utilisateur = :identifiant OR email = :identifiant ) AND mot_de_passe = :mot_de_passe');
		$t = $req->execute(array('identifiant' => $this->identifiant, 'mot_de_passe' => $this->mot_de_passe));
		//$resultat = $req->fetch();
		$t = $t->rowCount();
		return $t;
	}
}