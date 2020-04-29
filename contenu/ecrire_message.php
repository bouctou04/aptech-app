<?php
// Démarrage de la session
session_start();
	// Connexion à la base de données
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');

	// Vérification de la validité de la session
	if(isset($_SESSION['id']) AND $_SESSION['id'] > 0) {
		// Vérification de la validité du paramètre renvoyé
		if(isset($_GET['id']) AND $_GET['id'] > 0) {
	require '../frontend/Form.class.php';
	$form = new Form();

	// Si le formulaire d'envoie de message est rempli
	if(isset($_POST['sub_message'])) {
		// Vérification de la validité des champs de saisi
		if(!empty($_POST['message'])) {
			// Un peu de sécurité pour les données
			$msg = htmlspecialchars($_POST['message']);
			// Le message doit être envoyé à destinataire different de la session active
			if($_SESSION['id'] != $_GET['id']) {
			// Insertion du message dans la base de données
			$ins = $bdd->prepare('INSERT INTO Message(id_expediteur, id_destinataire, contenu, date_envoi) VALUES(?, ?, ?, NOW())');
			$ins->execute(array($_SESSION['id'], $_GET['id'], $msg));
			}
			// Si le destinataire correspond à la session active
			else {
				$erreur = 'Désolé, vous ne pouvez pas vous envoyer un message';
			}
		}
		// Si les champs de saisis ne sont pas valide
		else {
			$erreur = 'Votre message est vide !';
		}
	}

	// Récupération des messages entre $_SESSION['id'] && $_GET['id']
	$req_msg = $bdd->prepare('SELECT nom_utilisateur, id_expediteur, id_destinataire, contenu, date_envoi FROM Message INNER JOIN Utilisateur ON Utilisateur.id_utilisateur = Message.id_expediteur WHERE (id_expediteur = :id_expediteur AND id_destinataire = :id_destinataire) OR (id_expediteur = :id_destinataire AND id_destinataire = :id_expediteur) ORDER BY id_message DESC');
	$req_msg->execute(array('id_expediteur' => $_SESSION['id'], 'id_destinataire' => $_GET['id']));
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<h3 class="text-center font-weight-bold">Messages</h3>
						<div class="col-12">
							<form method="POST" class="form">
								<div class="form-group">
									<input type="hidden" value="<?= $_SESSION['username']; ?>" name="">
								</div>
								<div class="form-group">
									<textarea name="message" class="form-control" placeholder="Écrire votre message ici ..." rows="5"></textarea>
								</div>
								<div class="form-group">
									<button type="submit" name="sub_message" class="btn btn-primary w-100">Envoyer</button>
								</div>
								<?php 
									// Si on a une erreur, on affiche l'erreur
									if(isset($erreur)) { ?>
										<p class="text-center alert alert-danger">
										<?= $erreur ; ?>
										</p>
								<?php
									// Fermeture de if() ==> $erreur
									}
								?>
							</form>
							<table class="table">
							  <tbody>
							    <tr id="">
							    	<?php
							    		// Si on peut récupérer au moins un message
							    		if($req_msg->rowCount() > 0){
							    			// On récupère les colonnes de messages
							    			while($donnees = $req_msg->fetch()) {	
							    		 ?>
							    	<td class="row">
							    		<div class="pr-2">
							    			<img src="../media/img/FHI.png" class="rounded-pill" width="30">
							    		</div>
							    		<span class="font-weight-bold"><?php if($donnees['id_expediteur'] == $_SESSION['id']) { echo 'Moi : '; } else { echo '@'.$donnees['nom_utilisateur']; } ?> </span> 
							    		<span class="opacity-4 pl-2"><?= $donnees['contenu']; ?></span>
							    		<span class="pl-3 opacity-1 small">Il y'a 20min</span>
							    	</td>
							    	<?php
							    	// Fermeture de while()
							    	 }
							    	 // Fermeture de if()
							    		}
							    		// Si aucun message n'est été récupérer
							    		else { echo 'Pas de message !';} ?>
							    </tr>
							  </tbody>
							</table>
						</div>
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
} else { header('Location: ../index.php'); }
	} else { header('Location: ../index.php'); } ?>
