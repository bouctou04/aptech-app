<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    if(!empty($_GET['id']) AND $_GET['id'] > 0) {
        $getid = intval($_GET['id']);
        require_once '../models/Article.php';
        $article = new \Model\Article();
        if(!empty($article->find($getid))) {
           require_once 'include/header.php';
           require_once 'include/aside.php'; ?>
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
    ?>
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