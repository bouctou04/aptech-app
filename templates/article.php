<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    if(!empty($_GET['id']) AND $_GET['id'] > 0) {
        $getid = intval($_GET['id']);
        require_once '../models/Article.php';
        $article = new \Model\Article();
        if(!empty($article->find($getid))) {
           require_once 'include/header.php';
           require_once 'include/aside.php';
           require_once '../models/Comment.php';
           $comment = new \Model\Comment();
           require_once '../libraries/Form.class.php';
           $form = new Form();
           ?>
<div class="col-12 col-lg-9 border-left">
    <?php
    foreach ($article->find($getid) as $donnees): ?>
        <article class="row p-2 ml-2">
            <h2><?= $donnees['subject'] ?></h2>
            <p class="col-12">
                <?= $donnees['content'] ?>
            </p>
            <p class="opacity-1">
                <?= $donnees['send_date'] ?>
            </p>
        </article>
    <?php
        // Edite article
        if($_SESSION['id'] === 1): ?>
            <button type="button" class="btn-sm btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Modifier l'article</button>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifier l'article</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php
                            if(isset($_POST['edited'])) {
                                if(!empty($_POST['subject']) AND !empty($_POST['content'])) {
                                    $article->update($_GET['id'], $_POST['subject'], $_POST['content']); ?>
                                    <meta http-equiv="refresh" content="0 ; url=accueil.php">
                                    <?php
                                } else {
                                    $erreur = 'Les champs ne peuvent restés vides !';
                                    header("Location: accueil.php");
                                }
                            }
                            ?>
                            <form method="POST">
                                <div class="form-group">
                                    <input name="subject" type="text" class="form-control" placeholder="Titre de l'article" id="title" value="<?= $donnees['subject'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="content" class="col-form-label">Contenu de l'article</label>
                                    <textarea name="content" class="form-control" placeholder="Le contenu de l'article ici ..." id="content" rows="5"><?= $donnees['content'] ?></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    <button type="submit" name="edited" class="btn btn-success">Engregister</button>
                                </div>
                                <?php //$form->get_error(isset($erreur) ? $erreur : NULL); ?>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <button type="button" class="btn-sm btn-danger ml-2" data-toggle="modal" data-target="#delete">
                Supprimer cet article
            </button>

            <?php
            if(isset($_POST['delete'])) {
                $article->delete($getid);
                ?>
                <meta http-equiv="refresh" content="0 ; url=accueil.php">
                <?php
            }
            ?>

            <!-- Modal -->
            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteLabel">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer cet article ?
                        </div>
                        <div class="modal-footer">
                            <form method="POST">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            endif;
        endforeach;
    ?>
    <div class="offset-md-1 col-12 col-md-10 offset-md-1">
        <?php
        if(isset($_POST['submitted'])) {
            if(!empty($_POST['content'])) {
                $comment->insert(1, $_SESSION['id'], $getid, $_POST['content']);
                $success = "Votre commentaire a bien été publié !";
            } else {
                $erreur = "Veuillez rédiger un commentaire SVP !";
            }
        }
        ?>
        <table class="table">
            <tbody>
                <tr>
                    <td class="row">
                        <span class="font-weight-bold"><h4>Commentaires ...</h4></span>
                    </td>
                </tr>
                <tr>
                    <?php
                    if(!empty($comment->findAllBy(1, $getid))) {
                        foreach ($comment->findAllBy(1, $getid) as $donnees) { ?>
                            <td class="row">
                                <span class="font-weight-bold">@<?= $donnees['username'] ?></span>
                                <span class="opacity-4 pl-2"><?= $donnees['content'] ?></span>
                                <span class="pl-3 opacity-1 small"><?= $donnees['pub_date'] ?></span>
                            </td>
                        <?php
                        }
                    } else { ?>
                    <td>Pas de commentaire sur cet article !</td>
                    <?php
                    }
                    ?>
                </tr>
            </tbody>
        </table>
        <form method="POST" class="form">
            <div class="form-group">
                <?php $form->textarea("content", "form-control", "content", "Faites un commentaire ...", "5"); ?>
            </div>
            <div class="form-group">
                <?php $form->btn("submit", "submitted", "Poster le commentaire", "'btn btn-success w-100'"); ?>
            </div>
            <?php $form->get_error(isset($erreur) ? $erreur : NULL) ?>
            <?php $form->get_success(isset($success) ? $success : NULL) ?>
        </form>
    </div>
</div>
<?php
            require_once 'include/footer.php';
        } else {
            header("Location: 404.php");
        }
    } else {
        header("Location: 404.php");
    }
} else {
    header("Location: ../index.php");
}