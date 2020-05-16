<div class="col-12">
    <h1 class="title mt-n3 font-weight-bold">Espace d'administration</h1>
    <nav class="nav-extended blue-grey">
        <div class="nav-wrapper">
            <a href="#" data-target="space-menu" class="sidenav-trigger"><i class="fa fa-bars"></i></a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="index.php?page=space&&controller=index">Utilisateurs</a></li>
                <li><a href="index.php?page=space&&controller=internal">Gestion interne</a></li>
                <li><a href="collapsible.html">JavaScript</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="space-menu">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
    </ul>

    <div class="row">
        <?= $content; ?>
    </div>


   <!-- <div id="utilisateur" class="col s12"><?php require_once "views/space/admin/index.php"?></div>
    <div id="inscription" class="col s12"><?php require_once "views/space/admin/register.php"?></div>
    <div id="filiere" class="col s12"><?php require_once "views/space/admin/internal.php" ?></div> -->

    <!--<ul>
        <li>Lister les étudiants</li>
        <li>Lister les professeurs</li>
        <li>Gérer les emplois du temps</li>
        <li>Gérer les Filières</li>
        <li>Gérer les Matières</li>
        <li>Gérer les Niveaux</li>
        <li>Gérer les notes</li>
        <li>Gérer les cours</li>
        <li>État de paiement</li>
    </ul> -->
<?php
