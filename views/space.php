<div class="col-12">
    <h1 class="title mt-n3 font-weight-bold"><?= $page_title; ?></h1>
    <nav class="nav-extended blue-grey">
        <div class="nav-wrapper">
            <a href="#" data-target="space-menu" class="sidenav-trigger"><i class="fa fa-bars"></i></a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <?php
                if($_SESSION['category_id'] == 1) { ?>
                    <li><a href="index.php?page=space&&controller=index">Utilisateurs</a></li>
                    <li><a href="index.php?page=space&&controller=internal">Gestion interne</a></li>
                    <li><a href="index.php?page=space&&controller=payment">Paiement</a></li>
                    <li><a href="index.php?page=space&&controller=course">Cours</a></li>
                    <li><a href="index.php?page=maintenance">Bulletin</a></li>
                <?php
                } elseif ($_SESSION['category_id'] == 2) { ?>
                    <li><a href="index.php?page=space&&controller=index">Cours</a></li>
                    <li><a href="index.php?page=maintenance">Bulletin</a></li>
                <?php

                } else { ?>
                    <li><a href="index.php?page=space&&controller=payment">État de Paiement</a></li>
                    <li><a href="index.php?page=space&&controller=course">Cours</a></li>
                    <li><a href="index.php?page=maintenance">Bulletin</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>

    <ul class="sidenav blue-grey white-text" id="space-menu">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
    </ul>

    <div class="row">
        <?= $content; ?>
    </div>

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
