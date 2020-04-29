<?php
// Démarrage de la session
session_start();
	// Vérification de la validité de la session
	if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
		// Connexion à la base de données
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');

	require '../frontend/Form.class.php';
	$form = new Form();
	// Si le formulaire de topic est rempli
	if(isset($_POST['sub_forum'])) {
		//var_dump($_POST);
		// On s'assure que tous les champs requis sont valide
		if(!empty($_POST['sujet']) AND !empty($_POST['categorie']) AND !empty($_POST['contenu'])) {
			// Un peu de sécurité pour les données
			$sujet = htmlspecialchars($_POST['sujet']);
			$categorie = intval($_POST['categorie']);
			$contenu = htmlspecialchars($_POST['contenu']);
			$image = '';
				// Insertion du topic dans la base de données
				$ins = $bdd->prepare('INSERT INTO Forum(id_categorie, id_utilisateur, sujet, contenu, date_pub, resolu, image) VALUES(?, ?, ?, ?, NOW(), 0, ?)');
				$resultat = $ins->execute(array($categorie, $_SESSION['id'], $sujet, $contenu, $image));
		}
		// Si un champ requis n'est pas valide
		else {
			$erreur = 'Veuillez remplir les champs nécessaire SVP !';
		}
	}

	// Récuperation des topics de la base de données
	$req = $bdd->query('SELECT id_forum, type_categorie, Forum.id_utilisateur, nom_utilisateur, sujet, contenu, date_pub, resolu FROM Forum INNER JOIN Categorie_Forum ON Forum.id_categorie = Categorie_Forum.id_categorie INNER JOIN Utilisateur ON Forum.id_utilisateur = Utilisateur.id_utilisateur ORDER BY id_forum DESC');
	//var_dump($req->fetch());
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<h3 class="text-center font-weight-bold">Forum</h3>
						<div class="col-12">
							<table class="table">
							  <tbody>
							  	<?php
							  	// Si au moins un topic est récupérer
							  	if($req->rowCount() > 0){
							  		//Récupération des colonnes du topic
							  		while($donnees = $req->fetch()) { ?>
							    <tr>
							    	<td>
							    		<h4 class="d-inline"><a href="page.php?id=<?= $donnees['id_forum']; ?>"><?= $donnees['sujet']; ?></a></h4>
							    		<span>- [ <?= $donnees['type_categorie']; ?> ]</span>
							    		<span class="opacity-1"><?= $donnees['date_pub']; ?></span>
							    		<?php 
							    			// Si le topic est resolu
							    			if($donnees['resolu'] == 1) {
							    		 ?>
							    		<span class="float-right bg-success p-2 text-light">Résolu</span>
							    		<?php 
							    				// Fermeture de if topic resolu
							    				}
							    				// Si le topic n'est pas resolu
							    				 else { ?>
							    			<span class="float-right bg-danger p-2 text-light">Non Résolu</span>
							    		<?php
							    		// Fermeture de else topic !resolu
							    		}
							    		?>
							    	</td>
							    </tr>
								<?php 
										// Fermeture de while()
										}
									// Fermeture de if() donnees recupérér
									}
									// Si aucun topic n'est récupérer
									else { ?> 
										<tr class="col-12">
											<h3 class="text-center">Contenu vide !</h3>
										</tr>
								<?php
									// Fermeture de else
									 }
								 ?>
							  </tbody>
							</table>
							<form method="POST" enctype="data/multipart-form" class="form">
								<div class="font-weight-bold h4 bg-primary text-light p-3">
									Nouveau topic
								</div>
								<div class="form-group">
									<label for="topic_title" class="font-weight-bold h6">Titre du topic</label>
									<input type="text" name="sujet" id="topic_title" class="form-control" placeholder="Titre du topic">
								</div>
								<div class="form-group">
									<label for="topic_category" class="font-weight-bold h6">Catégorie</label>
									<select name="categorie" class="form-control">
										<?php
											// Selection des champs de la table categorie_forum
											$s = $bdd->query('SELECT * FROM Categorie_Forum');
											while($d = $s->fetch()) { ?>
										<option value="<?= $d['id_categorie']; ?>"><?= $d['type_categorie'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="topic_category" class="font-weight-bold h6">Contenu du topic</label>
									<textarea name="contenu" class="form-control" placeholder="Rédigez votre le contenu de votre tpic ici ..." rows="5"></textarea>
								</div>
								<div class="form-group">
									<label for="image" class="font-weight-bold h6">Image (facultative)</label>
									<input name="image" type="file" id="image" class="form-control" name="">
								</div>
								<div class="form-group">
									<button name="sub_forum" class="btn btn-primary w-100 font-weight-bold">Poster le topic</button>
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
<?php
// Fermeture de if session valide
 }
 // Si la session n'est pas valide
 else {
 	// Rédirection
 	header('Location: ../old-index.php');
 }
 ?>