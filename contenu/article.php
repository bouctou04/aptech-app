<?php
// Démarrage de la session
session_start();
// Vérification de la validité de la session
if(isset($_SESSION['id']) AND $_SESSION['id'] != 0) {
	// Vérification de la validité du paramètre de l'article
	if(isset($_GET['id']) AND $_GET['id'] > 0) {
		// Un peu de securité pour le paramètre de l'article
		$getid = intval($_GET['id']);
		// Connexion à la base de données
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');

	require '../frontend/Form.class.php';
	$form = new Form();

	// Si le formulaire de publication du commentaire est lancé
	if(isset($_POST['comment_valide'])) {
		// Vérification du remplissage valide des champs de saisi
		if(isset($_POST['contenu_commentaire']) AND !empty($_POST['contenu_commentaire'])) {
			// Un peu de sécurité pour les données renvoyés
			$contenu = htmlspecialchars($_POST['contenu_commentaire']);
			// INsertion du commentaire dans la base de données
			$req_add_commentaire = $bdd->prepare('INSERT INTO Commentaire(id_categorie, id_utilisateur, id_article, contenu, date_commentaire) VALUES(:id_categorie, :id_utilisateur, :id_article, :contenu, NOW())');
			$req_add_commentaire->execute(array('id_categorie' => 1, 'id_utilisateur' => $_SESSION['id'], 'id_article' => $getid, 'contenu' => $contenu));
		}
		// Si un des champs requis n'est pas renseigné
		else {
			$erreur = 'Vous ne pouvez pas publier un commentaire vide !';
		}
	}

	// Selection des commentaires appartenant à un article
	$req_select_commentaire = $bdd->prepare('SELECT Utilisateur.id_utilisateur, Utilisateur.nom_utilisateur, Commentaire.contenu, Commentaire.contenu, Commentaire.date_commentaire FROM Commentaire INNER JOIN categorie_commentaire ON categorie_commentaire.id_categorie = Commentaire.id_categorie INNER JOIN Utilisateur ON Utilisateur.id_utilisateur = Commentaire.id_utilisateur WHERE Commentaire.id_categorie = 1 AND Commentaire.id_article = :id_article');
	$req_select_commentaire->execute(array('id_article' => $getid));

	// Selection des informations sur l'article de la page
	$req = $bdd->prepare('SELECT * FROM Article WHERE id_article = :id_article');
	$req->execute(array('id_article' => $getid));
	//var_dump($req->fetch());
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
				
					<div class="col-12 col-lg-9 border-left">
						<?php
							// Récupération des colonnes de l'article
							while($donnees = $req->fetch()) { ?>
						<article class="row p-2 ml-2">
							<h2 class="text-dark"><?= $donnees['titre'] ?></h2>
							<p class="col-12">
								<a href="../media/img/unnamed.gif"><img src="../media/img/unnamed.gif" class="w-100"></a>
							</p>
							<p class="col-12">
								<?= $donnees['contenu']; ?>
							</p>
							<p class="opacity-1">
								<?= $donnees['date_pub'] ?>
							</p>
							<?php
								// Si l'utilisateur est "Administrateur" il peut supprimer l'article
								if($_SESSION['id'] == 1) { ?>
							<p class="col-6 float-right">
								<a href="supprime_article.php?id=<?= $getid; ?>" class="btn-sm btn-danger">Supprimer cet article</a>
							</p>
							<?php
								}
							?>
						</article>
						<?php } ?>
						<table class="table">
							  <tbody>
							  	<tr>
							  		<td class="row">
							    		<span class="font-weight-bold"><h4>Commentaires ...</h4></span> 
							    	</td>
							  	</tr>
							    <tr>
							    	<?php
							    		// Si on peut recupérer au moins 1 commentaire
							    		if($req_select_commentaire->rowCount() > 0){
							    			// Récupération des colonnes du commentaire
							    			while($donnees_comment = $req_select_commentaire->fetch()) { ?>
							    	<td class="row">
							    		<span class="font-weight-bold">@<?= $donnees_comment['nom_utilisateur'] ?> : </span> 
							    		<span class="opacity-4 pl-2"><?= $donnees_comment['contenu'] ?></span>
							    		<span class="pl-3 opacity-1 small"><?= $donnees_comment['date_commentaire'] ?></span>
							    	</td>
							    	<?php 
							    			}
							    		// Fermeture de if() 
							    		}
							    		// Si on ne peut pas recupérer de commentaire
							    		else { ?>
							    			<td>Pas de commentaire !</td>
							    	<?php
							    		// Fin de else
							    		}
							    	?>
							    </tr>
							  </tbody>
							</table>
						<div class="offset-md-1 col-12 col-md-10 offset-md-1">
							<form method="POST" class="form">
							<div class="form-group">
								<input type="hidden" name="" value="">
								<textarea name="contenu_commentaire" class="form-control" rows="5" placeholder="Votre commentaire ici ..."></textarea>
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
<?php require 'include/footer.php' ?>
<?php } else { header('Location accueil.php'); }
	} else { header('Location: ../index.php'); }
 ?>