<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<!-- <base href="/aptech-app/templates/"> -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/templates/style/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/templates/style/font/css/all.css">
		<link rel="stylesheet" type="text/css" href="/templates/style/css/style.css">
		<title></title>
	</head>
	<body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="accueil.php">Mon app</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="accueil.php"><span class="fa fa-home"></span> Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fa fa-user"></span> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="message.php"><span class="fa fa-envelope"></span> Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="chat.php"><span class="fa fa-comments"></span> Discussion générale</a>
                    </li>
                    <?php
                    if($_SESSION['category_id'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="inscription.php"><span class="fa fa-user-plus"></span> Ajouter un utilisateur</a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="forum.php"><span class="fa fa-smile"></span> Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fa fa-users"></span> Abonnés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fa fa-globe"></span> Notifications</a>
                    </li>
                </ul>
            </div>
            <a class="text-light text-decoration-none" href="logout.php"><span class="fa fa-power-off"></span> Déconnexion</a>
        </nav>
        <section class="row col-12">