<?php
// Démarrage de la session
session_start();
	
	// Connexion à la base de données
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');

// Vérification de la validité de la session
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
	// Vérification de la validité du paramètre renvoyé [Abonnement]
	if(isset($_GET['id']) AND $_GET['id'] > 0) {
		// Sécurité pour le paramètre renvoyé
		$getid = intval($_GET['id']);
		// Insertion de la ligne
		$req = $bdd->prepare('INSERT INTO Amis(id_expediteur, id_destinataire, date_ajout, confirm) VALUES(:id_expediteur, :id_destinataire, NOW(), 1)');
		$req->execute(array('id_expediteur' => $_SESSION['id'], 'id_destinataire' => $getid));
		// Rédirection
		header('Location: amis.php');
	} 
	// Si le paramètre concerne un désabonnement
	elseif (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
		// Sécurité pour le paramètre
		$getsupprime = intval($_GET['supprime']);
		// Selection de la ligne de désabonnement dans la base de donnée
		$req = $bdd->prepare('SELECT id FROM Amis WHERE (id_destinataire = :id_destinataire AND id_expediteur = :id_expediteur) OR (id_expediteur = :id_destinataire)');
		$req->execute(array('id_destinataire' => $_SESSION['id'], 'id_expediteur' => $getsupprime));
		$resultat = $req->fetch();
		// Retirement de la ligne
		$del = $bdd->prepare('DELETE FROM Amis WHERE id = :id');
		$del->execute(array('id' => $resultat['id']));
		// Rédirection
		header('Location: amis.php');
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
	header('Location: ../old-old_index.php');
}