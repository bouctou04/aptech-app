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
<div class="col-12 col-lg-8">
        <?php
            // L'utilisateur doit être 'Administrateur pour pouvoir publier un article'
            if($_SESSION['category_id'] == 1){
        ?>

                <?php
                require '../libraries/Form.class.php';
                $form = new Form();
                ?>
                <form method="POST">
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><span class="font-weight-bold">Publier un article</span></div>
                            <div class="collapsible-body">
                                    <div class="input-field">
                                        <?php
                                        $form->input("text", "subject", "subject", "validate", "255");
                                        $form->label("subject", "Titre de l'article");
                                        ?>
                                    </div>
                                    <div class="input-field">
                                        <?php
                                        $form->textarea("content", "content", "materialize-textarea");
                                        $form->label("content", "Contenu de l'article");
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="submitted" class="btn btn-success w-100">Publier l'article</button>
                                    </div>
                                    <?php
                                    $form->get_error(isset($erreur) ? $erreur : NULL);
                                    $form->get_success(isset($success) ? $success : NULL);
                                    ?>
                            </div>
                        </li>
                    </ul>
                </form>
        <?php
            }
        ?>

    <?php
    // Affichage d'article
    if(!empty($article->findAll())) {
        foreach ($article->findAll("ORDER BY id DESC LIMIT $depart, $articles_par_page") as $donnees): ?>
            <article class="">
                <div class="col-12">
                    <h1 class="title"><a href="article.php?id=<?= $donnees['id'] ?>"><?= $donnees['subject'] ?></a></h1>
                    <p class="text-justify">
                        <?= $donnees['excerpt'] ?>
                    </p>
                    <p class="opacity-1">
                        <?= $donnees['send_date'] ?>
                    </p>
                    <p>
                        <a class="btn btn-secondary" href="article.php?id=<?= $donnees['id'] ?>">Lire la suite</a>
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
</div>
<?php
    require_once 'include/aside.php';
    require 'include/footer.php' ?>
<?php
// Fermeture de if($_SESSION)
}
// Si la session n'existe pas
else { header('Location: ../index.php'); }
?>