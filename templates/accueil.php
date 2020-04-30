<?php
//Démarrage de la session
session_start();

// Connexion à la base de données
$bdd = new PDO('mysql:host=127.0.0.1;dbname=aptech_app;charset=utf8', 'root', '');

// Si la session existe et est active
if(isset($_SESSION['user']) AND $_SESSION['user'] != 0) {
	require '../libraries/Form.class.php';
	$form = new Form();

	// Si le formulaire post article est renvoyé
	if(isset($_POST['sub_actu'])) {
		// Le templates de POST ne peut pas être vide
		if(!empty($_POST['titre']) AND !empty($_POST['templates'])) {
			// Sécurité pour les données renvoyées
			$titre = htmlspecialchars($_POST['titre']);
			$contenu = htmlspecialchars($_POST['templates']);

			//Vérification de la présence d'image
			if(isset($_FILES['img'])) {
				var_dump($_FILES);
				$nom_img = $_FILES['img']['name'];
				$type_img = $_FILES['img']['type'];
				$extension = $_FILES['img']['name']['extension'];
				$taille_img = $_FILES['img']['size'];
				$tmp_img = $_FILES['img']['tmp_name'];
				$error = $_FILES['img']['error'];
				$chemin = '../media/img/post/'.$nom_img;

				move_uploaded_file($tmp_img, $chemin);

				echo $extension;
				 print_r(pathinfo($_FILES['img']['name']));
			} else { $chemin = '';}

			// Insertion des données dans la base de données
			$ins_article = $bdd->prepare('INSERT INTO Article(id_utilisateur, titre, templates, date_pub, image) VALUES(:id_utilisateur, :titre, :templates, NOW(), :image)');
			$ins_article->execute(array('id_utilisateur' => $_SESSION['id'], 'titre' => $titre, 'templates' => $contenu, 'image' => $chemin));

		// Fermeture de if()
		}
		// Si un champ est resté vide
		else {
			$erreur = 'Veuillez remplir l\'article SVP !';
			echo $erreur;
		}
	}

	// Nombre d'article par page
	$articles_par_page = 5;

	// Nombre total d'article
	$articles_total_req = $bdd->query('SELECT id FROM articles');
	$articles_total = $articles_total_req->rowCount();

	// Nombre total de page
	$page_totale = ceil($articles_total / $articles_par_page);

	//Vérification de la déclaration d'une page
	if(isset($_GET['page']) AND !empty($_GET['page'])) {
		// Un  peu de sécurité pour le paramètre de la page
		$_GET['page'] = intval($_GET['page']);

		// Déclaration de la page courante
		$page_courante = $_GET['page'];
	}
	// Si la page n'est pas déclarée on l'initialise automatiquement à la 1ère page
	else {
		// Initialisation de la page courante si elle n'est pas de définie
		$page_courante = 1;
	}

	// Départ d'affichage d'article par page
	$depart = ($page_courante - 1) * $articles_par_page;

	// Récuération des articles depuis la base de données
	$req_actu = $bdd->query('SELECT * FROM Article ORDER BY id_article DESC LIMIT '.$depart.', '.$articles_par_page.' ');
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 border-left">


							<?php
								// L'utilisateur doit être 'Administrateur pour pouvoir publier un article'
								if($_SESSION['id_category'] == 1){
							?>

							<div class="col-12">
								<form method="POST" class="form" enctype="multipart/form-data">
									<h4>Publier un nouvel article ...</h4>
									<div class="form-group">
										<input type="text" name="titre" class="form-control" placeholder="Titre de l'article">
									</div>
									<div class="form-group">
										<textarea name="contenu" class="form-control" rows="5" placeholder="Le contenu de l'article ici ..."></textarea>
									</div>
									<div class="form-group">
										<input type="file" name="img" class="form-control">
									</div>
									<div class="form-group">
										<button type="submit" name="sub_actu" class="btn btn-success w-100">Publier l'article</button>
									</div>
								</form>
							</div>
							<?php
								}
							?>

							<?php
								// Si on peut récupérer au moins 1 article
								if($req_actu->rowCount() > 0) {

									// Récupération de la colonne de l'article
									while($donnees = $req_actu->fetch()) { ?>

						<article class="row p-2 ml-2">
							<div class="col-12">
								<h3><a href="article.php?id=<?= $donnees['id_article'] ?>"><?= $donnees['titre'] ?></a></h3>
								<p class="">
									<?= $donnees['templates'] ?>
								</p>
								<p class="opacity-1">
									<?= $donnees['date_pub'] ?>
								</p>
							</div>
						</article>
						<?php
							// Fermeture de while()
							 }
							 // Fermeture de if()
						 }
						 // Si aucun article n'a été recupéré
						 else { ?>
							<article class="row">
								<h4 class="col-12 text-center">Aucun article</h4>
							</article>
						 <?php
						 	// Fermeture de else
							}
							?>

						<nav aria-label="...">
						  <ul class="pagination">
						    <li class="page-item disabled">
						      <span class="page-link">Previous</span>
						    </li>
						    <?php
						    // Système de pagination
						 	for($i = 1; $i <= $page_totale; $i++) {
						 		// Modification du lien dans la page courante
						 		if($i == $page_courante) { ?>
						 			 <li class="page-item active"><a class="page-link" href="accueil.php?page=<?= $i ?>"><?= $i ?></a></li>
						 		<?php
						 		// Fermeture de if()
						 		}
						 		// Si nous ne sommes pas la page courante
						 		else {
						 	 ?>
						    <li class="page-item"><a class="page-link" href="accueil.php?page=<?= $i ?>"><?= $i ?></a></li>
						    <?php
						    	// Fermeture de else
								}
								//Fermeture de for()
							 	}
							 ?>

						      <!-- <a class="page-link" href="#">Next</a> -->
						    </li>
						  </ul>
						</nav>
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
	// Fermeture de if($_SESSION)
	}
	// Si la session n'existe pas
	else { header('Location: ../old-old_index.php'); }
 ?>