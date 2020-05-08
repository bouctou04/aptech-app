<?php
    require_once '../models/Message.php';
    $message = new \Model\Message();
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- <base href="/aptech-app/templates/"> -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/templates/style/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/templates/style/css/materialize.css">
		<link rel="stylesheet" type="text/css" href="/templates/style/font/css/all.css">
		<link rel="stylesheet" type="text/css" href="/templates/style/css/style.css">
		<title></title>
	</head>
	<body>
    <nav>
        <div class="nav-wrapper teal">
            <a class="brand-logo right" href="accueil.php">APTECH</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><span class="material-icons"><i class="fa fa-bars"></i>
                <?php
                if($message->getUnread($_SESSION['id']) > 0) { ?>
                    <span class="red new badge"><?= $message->getUnread($_SESSION['id']) ?></span>
                    <?php
                }
                ?>
                </span></a>
            <ul class="left hide-on-med-and-down">
                <li>
                    <a class="" href="accueil.php"><span class="fa fa-home"></span> Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li>
                <a href="#"><span class="fa fa-user"></span> Profile</a>
                </li>
                <li>
                    <a href="message.php"><span class="fa fa-envelope"></span> Message
                        <?php
                        if($message->getUnread($_SESSION['id']) > 0) { ?>
                            <span class="red new badge"><?= $message->getUnread($_SESSION['id']) ?></span>
                        <?php
                        }
                        ?>
                    </a>
                </li>
                <li>
                    <a href="chat.php"><span class="fa fa-comments"></span> Discussion générale</a>
                </li>
                <?php
                if($_SESSION['category_id'] == 1) { ?>
                <li>
                    <a href="inscription.php"><span class="fa fa-user-plus"></span> Ajouter un utilisateur</a>
                </li>
                <?php
                }
                ?>
                <li>
                    <a href="forum.php"><span class="fa fa-smile"></span> Forum</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-users"></span> Abonnés</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-globe"></span> Notifications</a>
                </li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li>
            <a href="accueil.php"><span class="fa fa-home"></span> Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li>
            <a href="#"><span class="fa fa-user"></span> Profile</a>
        </li>
        <li>
            <a href="message.php"><span class="fa fa-envelope"></span> Message
                <?php
                if($message->getUnread($_SESSION['id']) > 0) { ?>
                    <span class="red new badge"><?= $message->getUnread($_SESSION['id']) ?></span>
                    <?php
                }
                ?>
            </a>
        </li>
        <li>
            <a href="chat.php"><span class="fa fa-comments"></span> Discussion générale</a>
        </li>
        <?php
        if($_SESSION['category_id'] == 1) { ?>
            <li>
                <a href="inscription.php"><span class="fa fa-user-plus"></span> Ajouter un utilisateur</a>
            </li>
            <?php
        }
        ?>
        <li>
            <a href="forum.php"><span class="fa fa-smile"></span> Forum</a>
        </li>
        <li>
            <a href="#"><span class="fa fa-users"></span> Abonnés</a>
        </li>
        <li>
            <a href="#"><span class="fa fa-globe"></span> Notifications</a>
        </li>
    </ul>



    <div class="container-fluid">
        <div class="row">
            <div class="col s5">
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><span class="fa fa-search"></span></div>
                        <div class="collapsible-body">
                            <form action="" class="">
                                <div class="input-field">
                                    <input type="search" id="search" class="validate">
                                    <label for="search"><span class="fa fa-search"></span> Rechercher une personne ...</label>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="">
                <div class="input-field">
                    <a href="#" data-target="slide-out" class="sidenav-trigger btn-floating pulse right"><i class="fa fa-user"></i></a>
                </div>
            </div>
        </div>
    </div>

    <ul id="slide-out" class="sidenav teal">
        <li><div class="user-view">
                <div class="background">
                    <img src="media/img/">
                </div>
                <a href="#user"><img class="circle" src="media/img/profile.jpg"></a>
                <a href="#name"><span class="white-text name font-weight-bold"><?= $_SESSION['first_name'] . ' ' . $_SESSION['last_name']?></span></a>
                <a href="#email"><span class="white-text email">@<?= $_SESSION['username'] ?></span></a>
            </div></li>
        <li><a class="waves-effect white-text" href="#!"><span class="fa fa-user"></span> Afficher mon profile</a></li>
        <li><a class="waves-effect white-text" href="#!"><span class="fa fa-pen"></span> Editer mon profile</a></li>
        <li><div class="divider"></div></li>
        <li><a class="waves-effect white-text" href="logout.php"><span class="fa fa-sign-out-alt"></span> Se déconnecter</a></li>
    </ul>
    <section class="container-lg row">