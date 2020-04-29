<?php
// Démarrage de la session
session_start();
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');
	if(isset($_SESSION['id']) AND $_SESSION['id'] != 0) {
	require '../frontend/Form.class.php';
	$form = new Form();
	if(isset($_POST['sub_chat'])) {
		if(!empty($_POST['message'])) {
			$message = htmlspecialchars($_POST['message']);
			$req = $bdd->prepare('INSERT INTO Chat(id_expediteur, contenu, date_envoi) VALUES(?, ?, NOW())');
			$req->execute(array($_SESSION['id'], $message));
		} else {
			$erreur = 'Vous ne pouvez pas envoyé un message vide !';
		}
	}
	$msg = $bdd->query('SELECT nom_utilisateur, id_expediteur, contenu, date_envoi FROM Chat INNER JOIN Utilisateur ON Chat.id_expediteur = Utilisateur.id_utilisateur ORDER BY id_chat DESC LIMIT 0,20');
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<h3 class="text-center font-weight-bold">Discussion générale</h3>
						<div class="col-12">
							<div class="row">
								<div class="col-lg-8 col-12">
									<form method="POST" class="form">
										<div class="form-group">
											<input type="hidden" value="<?= $_SESSION['username']; ?>" name="">
										</div>
										<div class="form-group">
											<textarea name="message" class="form-control" placeholder="Écrire votre message ici ..." rows="5"></textarea>
										</div>
										<div class="form-group">
											<button type="submit" name="sub_chat" class="btn btn-primary w-100">Envoyer</button>
										</div>
										<?php 
											if(isset($erreur)) { ?>
												<p class="text-center alert alert-danger">
												<?= $erreur ; ?>
												</p>
										<?php
											}
										?>
									</form>
								</div>
								<div class="d-none d-lg-inline d-xl-inline col-4 bg-light">
									<?php
										$user_nbr = $user_en_ligne->rowCount();
									?>
									<div class="font-weight-bold text-center bg-primary text-light p-2">Utilisateurs connectés (<?= $user_nbr; ?>)</div>
									<div>
										<ul>
											<?php
											if($user_nbr > 0) {
												while($user_co = $user_en_ligne->fetch()) { ?>
													<li><?= $user_co['nom_utilisateur']; ?></li>
											<?php
													}
												} else {
															echo 'Personne';
													}
												?>
											
										</ul>
									</div>
								</div>
							</div>
							<table class="table">
							  <tbody>
							    <tr id="chat">
							    	<?php
							    		if($msg->rowCount() > 0) {
							    			while($donnees = $msg->fetch()) { 
							    	?>
							    	<td class="row">
							    		<span class="font-weight-bold">
							    			<?php if($_SESSION['id'] == $donnees['id_expediteur']){
							    				echo 'Moi';
							    			} else { ?><a href="ecrire_message.php?id=<?= $donnees['id_expediteur'] ?>"><?php
							    				echo '@'.$donnees['nom_utilisateur'];
							    			} ?>
							    		</a> : </span> 
							    		<span class="opacity-4 pl-2"><?= nl2br($donnees['contenu']); ?></span>
							    		<span class="pl-3 opacity-1 small">Il y'a<?= $donnees['date_envoi']; ?></span>
							    	</td>
							    	<?php 
							    			}
							    		} else { ?>
							    	<td class="row text-center">Pas de message</td>
							    	<?php
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

<?php } else { header('Location: ../index.php'); } ?>