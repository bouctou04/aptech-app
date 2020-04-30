<?php
// Démarrage de la session
session_start();
	// Connexion à la base de données
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');
	// Si la session courante est valide
if(isset($_SESSION['id']) AND $_SESSION['id'] != 0) {
	// Vérification de la validité du paramètre renvoyé
	if(isset($_GET['id']) AND !empty($_GET['id'])) {
		// Un peu de sécurité pour le paramètre
		$getid = intval($_GET['id']);

	require '../frontend/Form.class.php';
	$form = new Form();

	// Si le formulaire de POST commentaire est rempli
	if(isset($_POST['comment_valide'])) {
		// Si les champs requis sont renseignés
		if(isset($_POST['contenu_commentaire']) AND !empty($_POST['contenu_commentaire'])) {
			//Un peu de sécurité pour les données
			$contenu = htmlspecialchars($_POST['contenu_commentaire']);
			// Insertion du commentaire dans la base de données
			$req_add_commentaire = $bdd->prepare('INSERT INTO Commentaire(id_categorie, id_utilisateur, id_article, templates, date_commentaire) VALUES(:id_categorie, :id_utilisateur, :id_article, :templates, NOW())');
			$req_add_commentaire->execute(array('id_categorie' => 2, 'id_utilisateur' => $_SESSION['id'], 'id_article' => $getid, 'templates' => $contenu));
		}
			// Si u champ requis est invalide
		 else {
			$erreur = 'Vous ne pouvez pas publier un commentaire vide !';
		}
	}

	// Selection des commentaires dans la base de données correspondant au paramètre
	$req_select_commentaire = $bdd->prepare('SELECT Utilisateur.id_utilisateur, Utilisateur.nom_utilisateur, Commentaire.templates, Commentaire.templates, Commentaire.date_commentaire FROM Commentaire INNER JOIN categorie_commentaire ON categorie_commentaire.id_categorie = Commentaire.id_categorie INNER JOIN Utilisateur ON Utilisateur.id_utilisateur = Commentaire.id_utilisateur WHERE Commentaire.id_categorie = 2 AND Commentaire.id_article = :id_article');
	$req_select_commentaire->execute(array('id_article' => $getid));

	// Selection du topic selon le paramètre
	$req = $bdd->prepare('SELECT id_forum, type_categorie, Forum.id_utilisateur, nom_utilisateur, sujet, templates, date_pub, resolu FROM Forum INNER JOIN Categorie_Forum ON Forum.id_categorie = Categorie_Forum.id_categorie INNER JOIN Utilisateur ON Forum.id_utilisateur = Utilisateur.id_utilisateur WHERE id_forum = :id_forum');
	$req->execute(array('id_forum' => $getid));
	// Récupération des infos du topic
	while($donnees = $req->fetch()){
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 border-left">
						<article class="row p-2 ml-2">
							<h2 class="text-dark"><?= $donnees['sujet'] ?></h2>
							<?php
								if(isset($donnees['img'])){ ?>
							<p class="col-12">
								<a href="media/img/unnamed.gif"><img src="media/img/unnamed.gif" class="w-100"></a>
							</p>
							<?php
								}
							?>
							<p class="col-12">
								<?= $donnees['templates'] ?>
							</p>
							<p class="offset-2 col-8 offset-2">
								<img class="w-100" src="media/img/unnamed.gif">
							</p>
							<p class="col-12">
								<span class="opacity-1"><?= $donnees['date_pub'] ?></span>
								<?php
									if($donnees['id_utilisateur'] == $_SESSION['id']) {
										if($donnees['resolu'] == 0) { ?> 
											<span class="float-right bg-success p-2 text-light"><a class="text-light" href="sujet_resolu.php?id=<?= $donnees['id_forum']; ?>">Résolu ?</a></span>
										<?php } else { ?>
											<span class="float-right bg-danger p-2 text-light"><a class="text-light" href="sujet_resolu.php?id=<?= $donnees['id_forum']; ?>">Non résolu ?</a></span>
										 <?php } ?>
								<?php
									} else { 
										if($donnees['resolu'] == 0) { ?>
											<span class="float-right bg-danger p-2 text-light">Non Résolu</span>
										 <?php } else { ?>
										 	<span class="float-right bg-success p-2 text-light">Résolu</span>
										  <?php }
										?>
								
								<?php
									}
								?>
							</p>
						</article>
						<table class="table">
							  <tbody>
							  	<tr>
							  		<td class="row">
							    		<span class="font-weight-bold"><h4>Commentaires ...</h4></span> 
							    	</td>
							  	</tr>
							    <tr>
							    	<?php
							    		if($req_select_commentaire->rowCount() > 0){
							    			while($donnees_comment = $req_select_commentaire->fetch()) { ?>
							    	<td class="row">
							    		<span class="font-weight-bold">@<?= $donnees_comment['nom_utilisateur'] ?> : </span> 
							    		<span class="opacity-4 pl-2"><?= $donnees_comment['templates'] ?></span>
							    		<span class="pl-3 opacity-1 small"><?= $donnees_comment['date_commentaire'] ?></span>
							    	</td>
							    	<?php 
							    			}
							    		} else { ?>
							    			<td>Pas de commentaire !</td>
							    	<?php
							    		}
							    	?>
							    </tr>
							  </tbody>
							</table>
						<div class="offset-md-1 col-12 col-md-10 offset-md-1">
							<form method="POST" class="form">
							<div class="form-group">
								<input type="hidden" name="" value="">
								<textarea class="form-control" name="contenu_commentaire" rows="5" placeholder="Votre commentaire ici ..."></textarea>
							</div>
							<div class="form-group">
								<button type="submit" name="comment_valide" class="btn btn-success w-100">Poster le commentaire</button>
							</div>
						</form>
						</div>
						
						<div class="invisible">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</div>
					<?php } ?>
<?php require 'include/footer.php' ?>
<?php 
	}else { header('Location: 404.php'); }
	 } else { header('Location: ../old-old_index.php'); }
	
 ?>