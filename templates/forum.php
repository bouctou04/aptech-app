<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    require_once '../models/Forum.php';
    $forum = new \Model\Forum();
    require_once 'include/header.php';
    require_once 'include/aside.php';?>
    <div class="col-12 col-lg-9 col-xl-9">
        <h3 class="text-center font-weight-bold">Forum</h3>
        <div class="col-12">
            <table class="table">
                <tbody>
                    <?php
                    if(!empty($forum->findAll())) {
                        foreach ($forum->findAll() as $donnees): ?>
                    <tr>
                        <td>
                            <h4 class="d-inline"><a href="page.php?id=<?= $donnees['id'] ?>"><?= $donnees['subject'] ?></a></h4>
                            <?php
                            if($donnees['resolved'] === 1) { ?>
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