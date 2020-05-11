<div class="col-12 col-lg-8">

    <?php
    $article = new \Model\Article();
// Show form insert article with user is admin
if($_SESSION['category_id'] == 1) {
    // Si le formulaire post article est renvoyé
    if(isset($_POST['submitted'])) {
        // Le formulaire de POST ne peut pas être vide
        if(!empty($_POST['subject']) AND !empty($_POST['content'])) {
            $article_file = NULL;
            if(strlen($_POST['subject']) <= 255 ) {
                // Upload file
                if(isset($_FILES['file-input']) AND !empty($_FILES['file-input']['name'])) {
                    $name = $_FILES['file-input']['name'];
                    $type = strtolower(substr(strrchr($name, "."), 1));
                    $tmp_name = $_FILES['file-input']['tmp_name'];
                    $file_error = $_FILES['file-input']['error'];
                    $size = $_FILES['file-input']['size'];

                    $max_size = 2097152;
                    $type_accept = array("jpg", "png", "gif", "jpeg");

                    if($size <= $max_size) {
                        if(in_array($type, $type_accept)) {
                            $path = 'public/media/article/img/'. $_POST['subject'] . '-' . date('d-m-Y') . '.' . $type;
                            $file_upload = move_uploaded_file($tmp_name, $path);
                            if($file_upload) {
                                $article_file = $path;
                            }
                        } else {
                            $erreur = "Votre fichier doit ếtre au format (jpg, jpeg, png, gif)";
                        }
                    } else {
                        $erreur = "Votre fichier ne doit pas dépasser 2Mo";
                    }
                }
                // Insert article
                $article->insert($_SESSION['id'], $_POST['subject'], $_POST['content'], $article_file);
                $success = "Votre article a bien été publié";
            } else {
                $erreur = "Le titre de votre article ne doit pas dépasser 255 caractères !";
            }
        }
        // Si un champ est resté vide
        else {
            $erreur = 'Veuillez remplir l\'article SVP !';
        }
    }
    ?>

    <form method="POST" enctype="multipart/form-data">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header"><span class="font-weight-bold">Publier un article</span></div>
                <div class="collapsible-body">
                    <div class="input-field">
                        <?php
                        $form->input("text", "subject", "subject", "validate", "255");
                        $form->label("subject", "Titre de l'article");
                        ?>
                    </div>
                    <div class="input-field">
                        <?php
                        $form->textarea("content", "content", "materialize-textarea");
                        $form->label("content", "Contenu de l'article");
                        ?>
                    </div>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Image</span>
                            <?php $form->input("file", "file-input"); ?>
                        </div>
                        <div class="file-path-wrapper">
                            <?php $form->input("text", "file", "file", "file-path validate", NULL, '"Importer une image (facultatif)"'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submitted" class="btn btn-success w-100">Publier l'article</button>
                    </div>
                    <?php
                    $form->get_error(isset($erreur) ? $erreur : NULL);
                    $form->get_success(isset($success) ? $success : NULL);
                    ?>
                </div>
            </li>
        </ul>
    </form>

<?php
}

// Show articles

    // Paginator
    $article_per_page = 5;
    $total_article = $article->rowCount();
    $total_page = ceil($total_article / $article_per_page);
    if(isset($_GET['index']) AND !empty($_GET['index'])) {
        $_GET['index'] = intval($_GET['index']);
        $current_page = $_GET['index'];
    } else {
        $current_page = 1;
    }
    $start = ($current_page - 1) * $article_per_page;

    if(!empty($article->findAll())) {
        foreach ($article->findAll("ORDER BY id DESC LIMIT $start, $article_per_page") as $datas):
            echo "
            <article>
                <div class='col-12'>
                    <h1 class='title'>
                        <a href='index.php?page=home&&action=show&&id=$datas[id]'>$datas[subject]</a>
                    </h1>
                    <p class='text-justify'>
                        $datas[excerpt]
                    </p>
                    <p class='opacity-1'>
                        $datas[send_date]
                    </p>
                </div>
            </article>
        ";
        endforeach;
    } else {
        echo "
     <article class=\"row\">
            <h4 class=\"col-12 text-center\">Aucun article</h4>
     </article>
    ";
    }

?>

    <div class="offset-4 col-4">
        <ul class="pagination pagination-sm">
            <?php
            if($current_page != 1){ ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=home&&index=<?= $current_page - 1 ?>">&laquo;</a>
                </li>
                <?php
            }else{ ?>
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
                <?php
            }
            for($i = 1; $i <= $total_page; $i++) {
                if($i == $current_page) { ?>
                    <li class="page-item  teal white-text" aria-current="page">
                        <a class="page-link teal white-text"><?= $i ?><span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                } else { ?>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="index.php?page=home&&index=<?= $i ?>"><?= $i ?><span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                }

            }
            ?>
            <?php
            if($current_page == $total_page){ ?>
                <li class="page-item disabled">
                    <span class="page-link">&raquo</span>
                </li>
                <?php
            } else { ?>
                <a class="page-link" href="index.php?page=home&&index=<?= $current_page + 1 ?>">&raquo</a>
                </li>
            <?php } ?>
        </ul>
    </div>

</div>

<aside class="d-none d-lg-inline d-xl-inline col-4">
    <div class="row">
        <div class="col s12 m5">
            <div class="card-panel teal">
                <div class="title white-text">Vos tendaces</div>
                <hr class="row white">
                <span class="white-text">I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m5">
            <div class="card-panel teal">
                <div class="title white-text">Suggestions</div>
                <hr class="row white">
                <span class="white-text">I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
                </span>
            </div>
        </div>
    </div>
</aside>