<?php
// Démarrage de la session
session_start();
	
	// Connexion à la base de données
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');

// Vérification de la validité de la session
if(isset($_SESSION['id']) AND !empty($_SESSION['id']) AND $_SESSION['id_category'] == 1) {
	// Vérification de la validité du paramètre renvoyé [Abonnement]
	if(isset($_GET['id']) AND $_GET['id'] > 0) {
		// Sécurité pour le paramètre renvoyé
		$getid = intval($_GET['id']);
		// Insertion de la ligne
		$req = $bdd->prepare('DELETE FROM Article WHERE id_article = :id_article');
		$req->execute(array('id_article' => $getid));
		// Rédirection
		header('Location: accueil.php');
	} 
	// Si le paramètre renvoyé ne concerne ni l'abonnement ni le débonnement
	else {
		// Rédirection
		header('Location: accueil.php');
	}
}
// Si la session n'est pas active
 else {
 	// Redirection
	header('Location: ../old-index.php');
}