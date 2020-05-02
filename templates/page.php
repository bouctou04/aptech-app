<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    require_once '../models/Forum.php';
    $forum = new \Model\Forum();
    if(!empty($_GET['id']) AND $_GET['id'] > 0 AND !empty($forum->find($_GET['id']))) {
        $getid = intval($_GET['id']);
        require_once 'include/header.php';
        require_once 'include/aside.php'; ?>
        <div class="col-12 col-lg-9 border-left">
            <?php
            foreach ($forum->find($getid) as $donnees):
            ?>
            <article class="row p-2 ml-2">
                <h2 class="text-dark"><?= $donnees['subject'] ?></h2>
                <p class="col-12">
                    <?= $donnees['content'] ?>
                </p>
                <p class="col-12">
                    <span class="text-muted small"><?= $donnees['pub_date'] ?></span>
                    <?php
                    if(isset($_GET['status'])) {
                        $status = intval($_GET['status']);
                        $forum->setResolved($status);
                        echo '<meta http-equiv="refresh" content="0 ; url=page.php?id='.$getid.'">';
                    }
                    if($donnees['users_id'] == $_SESSION['id']) {
                        if($donnees['resolved'] == 0) {
                            echo '<a href="page.php?id='.$getid.'&&status=1"><span class="float-right bg-success p-2 text-light">Résolu ?</span></a>';
                        } elseif ($donnees['resolved'] == 1) {
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
        </div>

<?php
        require_once 'include/footer.php';
    } else {
        header("Location: 404.php");
    }
} else {
    header("Location: ../index.php");
}