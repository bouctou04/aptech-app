<?php
//Démarrage de la session
session_start();

require_once '../models/Article.php';
$article = new \Model\Article();

// Si la session existe et est active
if(isset($_SESSION['id']) AND $_SESSION['id'] != 0) {

// Si le formulaire post article est renvoyé
if(isset($_POST['submitted'])) {
    // Le templates de POST ne peut pas être vide
    if(!empty($_POST['subject']) AND !empty($_POST['content'])) {
        // Insert article
        $article->insert($_SESSION['id'], $_POST['subject'], $_POST['content']);
        $success = "Votre article a bien été publié";
    }
    // Si un champ est resté vide
    else {
        $erreur = 'Veuillez remplir l\'article SVP !';
    }
}

// Nombre d'article par page
$articles_par_page = 5;

// Nombre total d'article
$articles_total = $article->row_count();

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

?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
<div class="col l8">
        <?php
            // L'utilisateur doit être 'Administrateur pour pouvoir publier un article'
            if($_SESSION['category_id'] == 1){
        ?>
                <?php
                require '../libraries/Form.class.php';
                $form = new Form();
                ?>
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header">Publier un article</div>
                        <div class="collapsible-body">
                            <form method="POST" class="">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="subject" type="text" class="validate" name="subject">
                                        <label for="subject">Titre de l'article</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="content" class="materialize-textarea" name="content"></textarea>
                                        <label for="content">Contenu de l'article</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>Fichier</span>
                                            <input type="file" multiple>
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" placeholder="Charger un fichier">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button class="btn waves-effect waves-light light-blue darken-4 col s12" type="submit" name="submitted">Publier</button>
                                </div>
                                <?php
                                if(isset($erreur)):
                                    echo $erreur;
                                endif;
                                ?>
                            </form>
                        </div>
                    </li>
                </ul>
        <?php
            }
        ?>

    <?php
    // Affichage d'article
    if(!empty($article->findAll())) {
        foreach ($article->findAll("ORDER BY id DESC LIMIT $depart, $articles_par_page") as $donnees): ?>
            <article class="row p-2 ml-2">
                <div class="col-12">
                    <h1 class="title"><a href="article.php?id=<?= $donnees['id'] ?>"><?= $donnees['subject'] ?></a></h1>
                    <p class="text-justify">
                        <?= $donnees['excerpt'] ?>
                    </p>
                    <p class="opacity-1">
                        <?= $donnees['send_date'] ?>
                    </p>
                    <p>
                        <a class="btn light-blue darken-4" href="article.php?id=<?= $donnees['id'] ?>">Lire la suite</a>
                    </p>
                </div>
            </article>
         <?php
        endforeach;
    } elseif (empty($article->findAll())) { ?>
        <article class="row">
            <h4 class="col-12 text-center">Aucun article</h4>
        </article>
    <?php
    }
    ?>

    <nav class="offset-4 col-4 offset-4" aria-label="...">
        <ul class="pagination pagination-sm">
            <?php
            if($page_courante != 1){ ?>
                <li class="page-item">
                    <span class="page-link"><a href="accueil.php?page=<?= $page_courante - 1 ?>">&laquo;</a></span>
                </li>
                <?php
            }else{ ?>
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
                <?php
            }
            for($i = 1; $i <= $page_totale; $i++) {
                if($i == $page_courante) { ?>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link"><?= $i ?><span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                } else { ?>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="accueil.php?page=<?= $i ?>"><?= $i ?><span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                }

            }
            ?>
            <?php
            if($page_courante == $page_totale){ ?>
                <li class="page-item disabled">
                    <span class="page-link">&raquo</span>
                </li>
                <?php
            } else { ?>
                <a class="page-link" href="accueil.php?page=<?= $page_courante + 1 ?>">&raquo</a>
                </li>
            <?php } ?>
        </ul>
    </nav>

<?php require 'include/footer.php' ?>
<?php
// Fermeture de if($_SESSION)
}
// Si la session n'existe pas
else { header('Location: ../index.php'); }
?>