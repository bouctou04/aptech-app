<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    if(!empty($_GET['id']) AND $_GET['id'] > 0) {
        $getid = intval($_GET['id']);
        require_once '../models/Article.php';
        $article = new \Model\Article();
        if(!empty($article->find($getid))) {
           require_once 'include/header.php';
           require_once '../models/Comment.php';
           $comment = new \Model\Comment();
           require_once '../libraries/Form.class.php';
           $form = new Form();
           ?>
<div class="col s12">
    <?php
    foreach ($article->find($getid) as $donnees): ?>
        <article class="row p-2 ml-2">
            <h3><?= $donnees['subject'] ?></h3>
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
            <button data-target="modal1" class="btn modal-trigger">Modifier l'article</button>

            <div id="modal1" class="modal">
                <div class="modal-content">
                    <h4>Modifier l'article</h4>
                    <?php
                    if(isset($_POST['edited'])) {
                        if(!empty($_POST['subject']) AND !empty($_POST['content'])) {
                            $article->update($_GET['id'], $_POST['subject'], $_POST['content']); ?>
                            <meta http-equiv="refresh" content="0 ; url=article.php?id=<?= $getid ?>">
                            <?php
                        } else {
                            $erreur = 'Les champs ne peuvent restés vides !';
                            header("Location: accueil.php");
                        }
                    }
                    ?>
                    <form method="POST">
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Titre de l'article" id="subject" name="subject" type="text" class="validate" value="<?= $donnees['subject'] ?>">
                                <label for="subject">Titre de l'article</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea name="content" id="content" class="materialize-textarea"><?= $donnees['content'] ?></textarea>
                                <label for="content">Contenu de l'article</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <button type="submit" name="edited" class="btn btn-success">Engregister</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Trigger -->
            <a class="waves-effect waves-light red lighten-1 btn modal-trigger" href="#delete">Supprimer cet article</a>

            <!-- Modal Structure -->
            <div id="delete" class="modal">
                <div class="modal-content">
                    <h4>Suppression de l'article</h4>
                    <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        <button class="modal-close waves-effect waves-green btn-flat">Annuler</button>
                        <button type="submit" name="delete" class="modal-close waves-effect red lighten-1 waves-green btn-flat">Supprimer</button>
                    </form>
                </div>
            </div>


            <?php
            if(isset($_POST['delete'])) {
                $article->delete($getid);
                ?>
                <meta http-equiv="refresh" content="0 ; url=accueil.php">
                <?php
            }
            ?>
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
        <div class="row">
            <table class="responsive-table">
                <tbody>
                <tr>
                    <td class="row">
                        <span class="font-weight-bold"><h4>Commentaires ...</h4></span>
                    </td>
                </tr>
                <tr>
                    <?php
                    if(!empty($comment->findAllBy(1, $getid))) {
                        foreach ($comment->findAllBy(1, $getid) as $donnees): ?>
                            <td class="">
                                <span class="font-weight-bold">@<?= $donnees['username'] ?></span>
                                <span class="opacity-4 pl-2"><?= $donnees['content'] ?></span>
                                <span class="pl-3 opacity-1 small"><?= $donnees['pub_date'] ?></span>
                            </td>
                        <?php
                        endforeach;
                    } else { ?>
                        <td>Pas de commentaire sur cet article !</td>
                        <?php
                    }
                    ?>
                </tr>
                </tbody>
            </table>
        </div>
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