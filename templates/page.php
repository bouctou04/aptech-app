<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    require_once '../models/Forum.php';
    $forum = new \Model\Forum();
    if(!empty($_GET['id']) AND $_GET['id'] > 0 AND !empty($forum->find($_GET['id']))) {
        $getid = intval($_GET['id']);
        require_once '../models/Comment.php';
        $comment = new \Model\Comment();
        require_once 'include/header.php'; ?>
        <div class="col-12 mt-n4">
            <?php
            foreach ($forum->find($getid) as $donnees):
            ?>
            <article class="row p-2 ml-2">
                <h1 class="title p-3 white-text teal"><?= $donnees['subject'] ?></h1>
                <p class="col-12">
                    <?= $donnees['content'] ?>
                </p>
                <p class="col-12">
                    <span class="text-muted small"><?= $donnees['pub_date'] ?></span>
                    <?php
                    if(isset($_GET['status'])) {
                        $status = intval($_GET['status']);
                        $forum->setResolved($getid, $status);
                        echo '<meta http-equiv="refresh" content="0 ; url=page.php?id='.$getid.'">';
                    }
                    if($donnees['users_id'] == $_SESSION['id']) {
                        if($donnees['resolved'] == 0) {
                            echo '<a href="page.php?id='.$getid.'&&status=1"><span class="float-right bg-success p-2 text-light">Résolu ?</span></a>';
                        } elseif
                        ($donnees['resolved'] == 1) {
                            echo '<a href="page.php?id='.$getid.'&&status=0"><span class="float-right bg-danger p-2 text-light">Non résolu ?</span></a>';
                        }
                    } else {
                        if($donnees['resolved'] == 0) {
                            echo '<span class="float-right bg-danger p-2 text-light">Non résolu</span>';
                        } elseif ($donnees['resolved'] === 1) {
                            echo '<span class="float-right bg-success p-2 text-light">Résolu</span>';
                        }
                    }
                    ?>
                </p>
            </article>
            <?php
            endforeach;
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
                        if(!empty($comment->findAllBy(2, $getid))) {
                            foreach ($comment->findAllBy(2, $getid) as $donnees): ?>
                                <td class="row">
                                    <span class="font-weight-bold">@<?= $donnees['username'] ?> : </span>
                                    <span class="opacity-4 pl-2"><?= $donnees['content'] ?></span>
                                    <span class="pl-3 opacity-1 small"><?= $donnees['pub_date'] ?></span>
                                </td>
                            <?php
                            endforeach;
                        } else {
                            echo '<td>Pas de commentaire ! </td>';
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
            <div class="offset-md-1 col-12 col-md-10 offset-md-1">
                <form method="POST">
                    <?php
                    require_once '../libraries/Form.class.php';
                    $form = new Form();
                    if(isset($_POST['submitted'])) {
                        if(!empty($_POST['content'])) {
                            $comment->insert(2, $_SESSION['id'], $getid, $_POST['content']);
                            $success = "Votre commentaire a bien été publié !";
                        } else {
                            $error = "Vous ne pouvez pas publier un commentaire vide !";
                        }
                    }
                    ?>
                    <div class="form-group">
                        <?php
                        $form->textarea("content", "form-control", "content", "Rédigez un commentaire ici ...", "4");
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        $form->btn("submit", "submitted", "Poster le commentaire", '"btn btn-success font-weight-bold w-100"');
                        ?>
                    </div>
                    <?php
                    $form->get_error(isset($error) ? $error : NULL);
                    $form->get_success(isset($success) ? $success : NULL);
                    ?>
                </form>
            </div>
        </div>

<?php
        require_once 'include/footer.php';
    } else {
        header("Location: 404.php");
    }
} else {
    header("Location: ../index.php");
}