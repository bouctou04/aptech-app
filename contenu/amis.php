<?php
// Démarrage de la session
session_start();
// Connexion à la base de données
$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');
	// Vérification de la validité de la session
	if(isset($_SESSION['id']) AND $_SESSION['id'] > 0) {
	require '../frontend/Form.class.php';
	$form = new Form();
	// $req = $bdd->prepare('SELECT nom_utilisateur, nom, prenom FROM Amis INNER JOIN Utilisateur ON Utilisateur.id_utilisateur = Amis.id_expediteur WHERE (id_expediteur = :mon_id OR id_destinataire = :mon_id) AND confirm = 1');
	// $req->execute(array('mon_id' => $_SESSION['id']));
	//var_dump($req->fetch());
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<h3 class="text-center font-weight-bold">Liste d'abonné</h3>
						<div class="col-12">
							<table class="table">
							  <tbody>
							  	<?php
							  		// Selection des lignes de la base de données
							  		$req = $bdd->prepare('SELECT id, id_destinataire, nom_utilisateur, nom, prenom FROM Amis INNER JOIN Utilisateur ON Utilisateur.id_utilisateur = Amis.id_expediteur WHERE (id_expediteur = :mon_id OR id_destinataire = :mon_id) AND confirm = 1');
										$req->execute(array('mon_id' => $_SESSION['id']));
									// Si on peut récupérer au moins une ligne
							  		if($req->rowCount() > 0){ 
							  			// Récupération des lignes
							  			while($donnees = $req->fetch()) {
							  				// Si la ligne courante corresond à celle de la session active
							  				if($donnees['nom_utilisateur'] != $_SESSION['username']){
							  		 ?>
							    <tr>
							      <td><a href="ecrire_message.php?id=<? $donnees['id_destinataire'] ?>">@<?= $donnees['nom_utilisateur'] ?></a> <span class="opacity-1"><?= $donnees['prenom'] ?> <?= $donnees['nom'] ?></span></td>
							      <td><a href="#">Bloqué</a> | <a href="abonne.php?supprime=<?= $donnees['id'] ?>">Suppprimer</a></td>
							    </tr>
							    <?php
							    // Fermeture de if() correspondant à la ligne de la session active
							     }
							     // Si la ligne courante ne correspond pas à la session active 
							     else {
							     		// Récupération des lignes dans la base de données
							    		$req_2 = $bdd->prepare('SELECT nom_utilisateur, nom, prenom FROM Utilisateur WHERE id_utilisateur = :id_utilisateur');
									$req_2->execute(array('id_utilisateur' => $donnees['id_destinataire']));
										$d = $req_2->fetch();
										?>
										<tr>
							      <td><a href="#">@<?= $d['nom_utilisateur'] ?></a> <span class="opacity-1"><?= $d['prenom'] ?> <?= $d['nom'] ?></span></td>
							      <td><a href="#">Bloqué</a> | <a href="abonne.php?supprime=<?= $donnees['id'] ?>">Suppprimer</a></td>
							    </tr>
										<?php
							    		// SI le nom est le même que le mien
							   		 }
							   	// Fermeture de while()
							    }
							    // Fermeture de if() ==> aucune ligne
									}
									// Si aucune ligne n'a été recupérée dans la base de donnée
									else { ?> 
								<div class="col-12">
									<h3 class="text-center">Vous n'avez aucun abonné</h3>
								</div>
								<?php 
									// Fermeture de else
									}
								?>
							  </tbody>
							</table>
						</div>
						<div class="invisible">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</div>
<?php require 'include/footer.php' ?>
<?php 
// Fermeture de if() ==> Validité de la session
}
// Si la session n'est pas valide
else {
	// Rédirection
	header('Location: ../old-index.php');
}
?>