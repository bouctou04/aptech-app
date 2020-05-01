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
           ?>
<div class="col-12 col-lg-9 border-left">
    <?php
    foreach ($article->find($getid) as $donnees) { ?>
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
    }
    // Modification de l'article
    if($_SESSION['id'] === 1)  {

    }
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
            <?php
            require_once '../libraries/Form.class.php';
            $form = new Form();
            ?>
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
        } else {
            header("Location: 404.php");
        }
    } else {
        header("Location: 404.php");
    }
} else {
    header("Location: ../index.php");
}