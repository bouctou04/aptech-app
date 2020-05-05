<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<!-- <base href="/aptech-app/templates/"> -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/templates/style/css/main4.css">
		<link rel="stylesheet" type="text/css" href="/templates/style/materialize/css/materialize.css">
		<link rel="stylesheet" type="text/css" href="/templates/style/font/css/all.css">
		<link rel="stylesheet" type="text/css" href="/templates/style/css/style.css">
		<title></title>
	</head>
	<body>
    <nav>
        <div class="nav-wrapper light-blue darken-4">
            <a class="right" href=""><span class="fa fa-power-off"></span> Se déconnecter</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><span class="material-icons"><i class="fa fa-bars"></i> Menu</span></a>
            <ul class="left hide-on-med-and-down">
                <li class="active">
                    <a class="" href="accueil.php"><span class="fa fa-home"></span> Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="">
                    <a class="" href="#"><span class="fa fa-user"></span> Profile</a>
                </li>
                <li class="">
                    <a class="" href="message.php"><span class="fa fa-envelope"></span> Message</a>
                </li>
                <li class="">
                    <a class="" href="chat.php"><span class="fa fa-comments"></span> Discussion générale</a>
                </li>
                <li class="">
                    <a class="" href="inscription.php"><span class="fa fa-user-plus"></span> Ajouter un utilisateur</a>
                </li>
                <li class="">
                    <a class="" href="forum.php"><span class="fa fa-smile"></span> Forum</a>
                </li>
                <li class="">
                    <a class="" href="#"><span class="fa fa-users"></span> Abonnés</a>
                </li>
                <li class="">
                    <a class="" href="#"><span class="fa fa-globe"></span> Notifications</a>
                </li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li class="active">
            <a class="text-decoration-none" href="accueil.php"><span class="fa fa-home"></span> Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li class="">
            <a class="" href="#"><span class="fa fa-user"></span> Profile</a>
        </li>
        <li class="">
            <a class="" href="message.php"><span class="fa fa-envelope"></span> Message</a>
        </li>
        <li class="">
            <a class="" href="chat.php"><span class="fa fa-comments"></span> Discussion générale</a>
        </li>
        <li class="">
            <a class="" href="inscription.php"><span class="fa fa-user-plus"></span> Ajouter un utilisateur</a>
        </li>
        <li class="">
            <a class="" href="forum.php"><span class="fa fa-smile"></span> Forum</a>
        </li>
        <li class="">
            <a class="" href="#"><span class="fa fa-users"></span> Abonnés</a>
        </li>
        <li class="">
            <a class="" href="#"><span class="fa fa-globe"></span> Notifications</a>
        </li>
    </ul>
    <form class="row">
        <div class="offset-l4 col l4 col s12">
            <div class="input-field col s12">
                <input id="icon_prefix" type="text" class="validate">
                <label for="icon_prefix"><i class="fa fa-search"></i> Réchercher une personne</label>
            </div>
        </div>
    </form>
        <section class="container row">