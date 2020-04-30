<?php
// Démarrage de la session
session_start();

// Vérification de la validité de la session
if(isset($_SESSION['id']) AND $_SESSION['id'] > 0) {
	// Connexion à la base de données
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');

	require '../frontend/Form.class.php';
	$form = new Form();

	// Récupération des messages depuis la base de données
	$req = $bdd->prepare('SELECT DISTINCT id_utilisateur, nom_utilisateur, templates, date_envoi FROM Message INNER JOIN Utilisateur ON Utilisateur.id_utilisateur = Message.id_expediteur WHERE id_expediteur = :mon_id OR id_destinataire = :mon_id');
	$req->execute(array('mon_id' => $_SESSION['id']));
	//print_r($req->fetch());
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<h3 class="text-center font-weight-bold">Messages</h3>
						<div class="col-12">
							<table class="table">
							  <tbody>
							    <tr>
							    	<?php
							    	// Si on peut récupérer au moins un message
							    		if($req->rowCount() > 0) {
							    			// Récupération des lignes de message
							    			while($donnees = $req->fetch()) {
							    		 ?>
							    	<td class="row">
							    		<div class="pr-2">
							    			<img src="media/img/FHI.png" class="rounded-pill" width="30">
							    		</div>
							    		<span class="font-weight-bold"><a href="ecrire_message.php?id=<?= $donnees['id_utilisateur'] ?>">@<?= $donnees['nom_utilisateur'] ?></a> : Moi </span> 
							    		<span class="opacity-4 pl-2"><?= $donnees['templates'] ?></span>
							    		<span class="pl-3 opacity-1 small">Il y'a 20min</span>
							    	</td>
							    <?php 
							    		// Fermeture de while()
										}
									// Fermeture de if()
									}
									// Si aucun message n'a été récupérer
									else { ?> 
							    	<td class="row">
							    		<h4 class="col-12 text-center">Vous n'avez pas de message</h4>
							    	</td>
							     <?php
								     // Fermeture de else
								      } 
							      ?>
							    </tr>
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
// Fermeture de if() ==> $_SESSION
}
// Si la session n'est pas valide
 else {
 	// Rédirection
	header('Location: ../old-old_index.php');
}