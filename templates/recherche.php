<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');
	require '../frontend/Form.class.php';
	$form = new Form();
	if(isset($_GET['s'])) {
		if(isset($_GET['w']) AND !empty($_GET['w'])) {
			$word = $_GET['w'];
			$req = $bdd->query("SELECT id_utilisateur, type_categorie, nom_utilisateur, nom, prenom FROM Utilisateur INNER JOIN categorie_utilisateur ON categorie_utilisateur.id_categorie = Utilisateur.id_categorie WHERE nom_utilisateur LIKE '%$word%' OR nom LIKE '$word' OR prenom LIKE '$word' OR (prenom AND nom LIKE '$word')");
			//$resultat = $req->fetch();
			//var_dump($resultat);
		} else {
			$erreur = 'Veuillez lancer votre recherche';
		}
	}
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<h3 class="text-center font-weight-bold">Recherche</h3>
						<form method="GET" class="row form">
							<div class="form-group col-11">
								<input type="search" name="w" class="form-control" placeholder="Recherche" name="">
							</div>
							<div class="form-group col-1 ml-n5">
								<button type="submit" name="s" class="btn btn-primary"><span class="fa fa-search"></span></button>
							</div>
						</form>
						<div class="col-12">
							<table class="table">
							  <tbody>
							  	<?php
							  		if($req->rowCount() > 0) {
							  		while($resultat = $req->fetch()) { 
							  			$req_user = $bdd->prepare('SELECT confirm FROM Utilisateur INNER JOIN Amis ON Utilisateur.id_utilisateur = Amis.id_expediteur WHERE (Amis.id_expediteur = :id_expediteur AND Amis.id_destinataire = :id_destinataire)');
							  			$req_user->execute(array('id_expediteur' => $_SESSION['id'], 'id_destinataire' => $resultat['id_utilisateur']));
							  			$is_amis = $req_user->fetch();
							  			//var_dump($is_amis);
							  			?>
							    <tr>
							      <td>
							      	<a href="#">@<?= $resultat['nom_utilisateur'] ?></a> <span class="opacity-1"><?= $resultat['prenom'] ?> <?= $resultat['nom'] ?></span>
							      </td>
							      <td>
							      	<span class="opacity-1"><?= $resultat['type_categorie'] ?></span>
							      </td>
							      <?php
							      	if($_SESSION['id'] != $resultat['id_utilisateur']){
							      		if($is_amis['confirm'] == 1) { ?>
							      <td><span class="btn-sm btn-light">Déjà abonné</span></td>
							  <?php } elseif($is_amis['confirm'] == 0) { ?> 
							  		<td><a href="abonne.php?id=<?= $resultat['id_utilisateur'] ?>" class="btn-sm btn-success">S'abonné</a></td>
							   <?php } ?>
							    </tr>
								<?php }
									} 
										}else { ?>
											<div class="col-12">
												<h4 class="text-center">Pas de resultat pour <?= $word; ?></h4>
											</div>	
										 <?php  } ?>
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