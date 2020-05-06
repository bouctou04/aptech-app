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
<div class="col-12 mt-n4">
    <?php
    foreach ($article->find($getid) as $donnees): ?>
        <article class="row p-2 ml-2">
            <h1 class="title teal white-text p-3"><?= $donnees['subject'] ?></h1>
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
            <div class="row">
                <div class="col-4 col-lg-3">
                    <a class="waves-effect waves-light btn modal-trigger" href="#edit"><span class="fa fa-pen"></span> Modifier l'article</a>
                </div>
                <div class="col-4 col-lg-3">
                    <a class="waves-effect waves-light red darken-2 btn modal-trigger" href="#delete"><span class="fa fa-trash"></span> Supprimer l'article</a>
                </div>
            </div>
            <div id="edit" class="modal">
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
                        <div class="input-field">
                            <input name="subject" type="text" class="validate" id="title" value="<?= $donnees['subject'] ?>">
                            <label for="subject">Titre de l'article</label>
                        </div>
                        <div class="input-field">
                            <textarea name="content" class="materialize-textarea" id="content"><?= $donnees['content'] ?></textarea>
                            <label for="content">Contenu de l'article</label>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn indigo lighten-5 black-text" data-dismiss="modal">Annuler</button>
                            <button type="submit" name="edited" class="btn btn-success">Engregister</button>
                        </div>
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

            <div id="delete" class="modal">
                <div class="modal-content">
                    <h4>Demande de confirmation</h4>
                    <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <button type="submit" class="btn ">Annuler</button>
                        <button type="submit" name="delete" class="btn red darken-2">Supprimer</button>
                    </form>
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
                        foreach ($comment->findAllBy(1, $getid) as $donnees): ?>
                            <td class="row">
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
        <form method="POST" class="form">
            <div class="container">
                <div class="input-field">
                    <?php
                    $form->textarea("content", "content");
                    $form->label("content", "Rédiger un commentaire ...");
                    $form->btn("submit", "submitted", "Publier", "'btn right'");
                    ?>
                </div>
                <?php $form->get_error(isset($erreur) ? $erreur : NULL) ?>
                <?php $form->get_success(isset($success) ? $success : NULL) ?>
            </div>
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