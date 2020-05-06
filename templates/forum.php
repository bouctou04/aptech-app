<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    require_once '../models/Forum.php';
    $forum = new \Model\Forum();

    // Nombre d'article par page
    $articles_par_page = 5;

// Nombre total d'article
    $articles_total = $forum->row_count();

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

    require_once 'include/header.php'; ?>
    <div class="col-12">
        <h1 class="title mt-n3 font-weight-bold">Forum</h1>
        <div class="col-12">
            <form method="POST">
                <?php
                require_once '../libraries/Form.class.php';
                $form = new Form();
                if(isset($_POST['submitted'])) {
                    if(!empty($_POST['subject']) AND !empty($_POST['content'])) {
                        if(strlen($_POST['subject']) <= 255) {
                            $forum->insert($_SESSION['id'], $_POST['subject'], $_POST['content']);
                            $success = "Votre topic a été publié avec succès !";
                        } else {
                            $error = "Le titre du topic ne doit pas dépasser 255 caractères !";
                        }
                    } else {
                        $error = "Veuillez remplir le topic SVP !";
                    }
                }
                ?>
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><span class="font-weight-bold">Publier un article</span></div>
                        <div class="collapsible-body">
                            <div class="input-field">
                                <?php
                                $form->input("text", "subject", "subject", "validate", "255");
                                $form->label("subject", "Sujet du topic");
                                ?>
                            </div>
                            <div class="input-field">
                                <?php
                                $form->textarea("content", "content");
                                $form->label("content", "Contenu du topic");
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $form->btn("submit", "submitted", "Poster le topic", '"btn btn-success font-weight-bold w-100"');
                                ?>
                            </div>
                            <?php
                            $form->get_error(isset($error)? $error : NULL);
                            $form->get_success(isset($success)? $success : NULL);
                            ?>
                        </div>
                    </li>
                </ul>

            </form>
            <table class="table">
                <tbody>
                    <?php
                    if(!empty($forum->findAll())) {
                        foreach ($forum->findAll("ORDER BY id DESC LIMIT $depart, $articles_par_page") as $donnees): ?>
                    <tr>
                        <td>
                            <h1 class="title d-inline"><a href="page.php?id=<?= $donnees['id'] ?>"><?= $donnees['subject'] ?></a></h1>
                            <?php
                            if($donnees['resolved'] == 1) { ?>
                                <span class="float-right bg-success p-2 text-light">Résolu</span>
                            <?php
                            } else { ?>
                                <span class="float-right bg-danger p-2 text-light">Non résolu</span>
                            <?php
                            }
                            ?>
                            <span class="text-muted small d-block"><?= $donnees['pub_date'] ?></span>
                        </td>
                    </tr>
                        <?php
                            endforeach;
                    } else { ?>
                        <tr>
                            <td>Cette section ne contient pas d'information pour le moment !</td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>

            <div class="offset-4 col-4">
                <ul class="pagination pagination-sm">
                    <?php
                    if($page_courante != 1){ ?>
                        <li class="page-item">
                            <a class="page-link" href="forum.php?page=<?= $page_courante - 1 ?>">&laquo;</a>
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
                            <li class="page-item teal white-text" aria-current="page">
                                <a class="page-link teal white-text"><?= $i ?><span class="sr-only">(current)</span></a>
                            </li>
                            <?php
                        } else { ?>
                            <li class="page-item" aria-current="page">
                                <a class="page-link" href="forum.php?page=<?= $i ?>"><?= $i ?><span class="sr-only">(current)</span></a>
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
                        <a class="page-link" href="forum.php?page=<?= $page_courante + 1 ?>">&raquo</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
<?php
require_once 'include/footer.php';
} else {
    header("Location: ../index.php");
}