<?php
	require 'en_ligne.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<base href="/aptech-project/contenu/">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../style/css/main.css">
		<link rel="stylesheet" type="text/css" href="../style/font/css/all.css">
		<link rel="stylesheet" type="text/css" href="../style/css/style.css">
		<title></title>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 w-100">
					<nav>
						<ul class="d-none d-lg-block list-unstyled bg-primary p-2 font-weight-bold">
							<li class="d-inline mr-2">
								<a href="accueil.php?id=<?= $_SESSION['id']; ?>" class="text-light">
									<img src="../media/img/aptech.png" width="30" height="30" class="d-inline-block align-top" alt="">
								</a>
							</li>
							<!-- <li class="d-inline mr-3">
								<a href="accueil.php?id=<?= $_SESSION['id']; ?>" class="active text-light">Accueil</a>
							</li> -->
							<li class="d-inline mr-3">
								<a href="profile.php?id=<?= $_SESSION['id']; ?>" class="text-light"><span class="fa fa-user"></span> Profile</a>
							</li>
							<li class="d-inline mr-3">
								<a href="message.php?id=<?= $_SESSION['id']; ?>" class="text-light"><span class="fa fa-envelope"></span> Message</a>
							</li>
							<li class="d-inline mr-3">
								<a href="chat.php?id=<?= $_SESSION['id']; ?>" class="text-light"><span class="fa fa-comments"></span> Chat Générale</a>
							</li>
							<?php
									if($_SESSION['id_category'] == 1) { ?>
									<li class="d-inline mr-3">
								<a href="inscription.php?id=<?= $_SESSION['id']; ?>" class="text-light"><span class="fa fa-user-plus"></span> Ajouter un utilisateur</a>
							</li>
							<?php } ?>
							<li class="d-inline mr-3">
								<a href="evaluation.php?id=<?= $_SESSION['id']; ?>" class="text-light"><span class="fa fa-calculator"></span> Évaluation</a>
							</li>
							<li class="d-inline mr-3">
								<a href="forum.php?id=<?= $_SESSION['id']; ?>" class="text-light"><span class="fa fa-smile"></span> Forum</a>
							</li>
								<li class="d-inline mr-3">
								<a href="amis.php?id=<?= $_SESSION['id']; ?>" class="text-light"><span class="fa fa-users"></span> Abonnés</a>
							</li>
							<li class="d-inline mr-3">
								<a href="notifications.php?id=<?= $_SESSION['id']; ?>" class="text-light"><span class="fa fa-globe"></span> Notifications</a>
							</li>
							<li class="d-inline mr-3 float-right">
								<a href="deconnexion.php?id=<?= $_SESSION['id']; ?>" class="text-light"><span class="fa fa-power-off"></span> Deconnexion</a>
							</li>
						</ul>
						<!-- Menu mobile -->

						<div class="d-lg-none d-sm-block d-md-block list-unstyled text-right p-3 bg-primary">
							<li class="d-inline float-left text-left">
								<img src="../media/img/aptech.png" width="150">
							</li>
							<div class="btn-group dropleft">
								<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
									<li class="d-inline mr-3">
										<a href="accueil.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-home"></span> Accueil</a>
									</li>
									<li class="d-inline mr-3">
										<a href="profile.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-user"></span> Profile</a>
									</li>
									<li class="d-inline mr-3">
										<a href="message.php?id=<?= $_SESSION['id']; ?>" class=" dropdown-item"><span class="fa fa-envelope"></span> Message</a>
									</li>
									<li class="d-inline mr-3">
										<a href="chat.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-comments"></span> Discussion Générale</a>
									</li>
									<?php
									if($_SESSION['id_category'] == 1) { ?>
									<li class="d-inline mr-3">
										<a href="inscription.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-user-plus"></span> Ajouter un utilisateur</a>
									</li>
									<?php } ?>
									<li class="d-inline mr-3">
										<a href="evaluation.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-calculator"></span> Évaluation</a>
									</li>
									<li class="d-inline mr-3">
										<a href="forum.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-smile"></span> Forum</a>
									</li>
										<li class="d-inline mr-3">
										<a href="amis.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-users"></span> Abonnés</a>
									</li>
									<li class="d-inline mr-3">
										<a href="notifications.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-globe"></span> Notifications</a>
									</li>
									<li class="d-inline mr-3">
										<a href="recherche.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-search"></span> Recherche</a>
									</li>
									<li class="d-inline mr-3">
										<a href="deconnexion.php?id=<?= $_SESSION['id']; ?>" class="dropdown-item "><span class="fa fa-power-off"></span> Deconnexion</a>
									</li>
								</ul>
							</div>
						</div>

						<!-- END mobile menu -->
					</nav>
				</div>
				<section class="row">