<?php
// Démarage de la session
session_start();
	// Connexion à la base de données
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');

// Vérification de la validité de la session
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
	// Vérification de la validité du paramètre ==> Forum
	if(isset($_GET['id']) AND $_GET['id'] > 0) {
		// Un peu de sécurité pourle paramètre
		$getid = intval($_GET['id']);
		// Récupération des infos concernant le forum consulté
		$requser = $bdd->prepare('SELECT resolu FROM Forum WHERE id_forum = :id_forum');
		$requser->execute(array('id_forum' => $getid));
		$resultat = $requser->fetch();
		
		// Si le forum n'est pas resolu
		if($resultat['resolu'] == 0) {
		// Initialisation de ligne de résolution du forum
		$req = $bdd->prepare('UPDATE Forum SET resolu = 1 WHERE id_forum = :id_forum');
		$req->execute(array('id_forum' => $getid));
		header('Location: page.php?id='.$getid);
		} 
		// Si le forum est résolu
		elseif($resultat['resolu'] == 1) {
			// Initialisation de ligne de résolution du forum
			$req = $bdd->prepare('UPDATE Forum SET resolu = 0 WHERE id_forum = :id_forum');
			$req->execute(array('id_forum' => $getid));
			// Rédirection
			header('Location: page.php?id='.$getid);
		} else { echo 'Beurk !'; }
	}
}
// Si la session n'est pas valide
 else {
	header('Location: ../old-index.php');
}