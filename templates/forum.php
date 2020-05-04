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

    require_once 'include/header.php';
    require_once 'include/aside.php';?>
    <div class="col-12 col-lg-9 col-xl-9">
        <h3 class="text-center font-weight-bold">Forum</h3>
        <div class="col-12">
            <table class="table">
                <tbody>
                    <?php
                    if(!empty($forum->findAll())) {
                        foreach ($forum->findAll("ORDER BY id DESC LIMIT $depart, $articles_par_page") as $donnees): ?>
                    <tr>
                        <td>
                            <h4 class="d-inline"><a href="page.php?id=<?= $donnees['id'] ?>"><?= $donnees['subject'] ?></a></h4>
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

            <nav class="offset-4 col-4 offset-4" aria-label="...">
                <ul class="pagination pagination-sm">
                    <?php
                    if($page_courante != 1){ ?>
                        <li class="page-item">
                            <span class="page-link"><a href="forum.php?page=<?= $page_courante - 1 ?>">&laquo;</a></span>
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
            </nav>

            <form method="POST">
                <?php
                require_once '../libraries/Form.class.php';
                $form = new Form();
                if(isset($_POST['submitted'])) {
                    if(!empty($_POST['subject']) AND !empty($_POST['content'])) {
                        $forum->insert($_SESSION['id'], $_POST['subject'], $_POST['content']);
                        $success = "Votre topic a été publié avec succès !";
                    } else {
                        $error = "Veuillez remplir le topic SVP !";
                    }
                }
                ?>
                <div class="form-group">
                    <?php
                    $form->label("subject", "Sujet du topic", "font-weight-bold h6");
                    $form->input("text", "subject", "subject", "form-control", '"Écrivez ici le titre de votre topic"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $form->label("content", "Contenu du topic", "font-weight-bold h6");
                    $form->textarea("content", "form-control", "content", "Contenu du topic");
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
            </form>
        </div>
    </div>
<?php
require_once 'include/footer.php';
} else {
    header("Location: ../index.php");
}