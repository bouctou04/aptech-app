<div class="col-12">
    <h1 class="title mt-n3 font-weight-bold">Forum</h1>
    <div class="col-12">
        <form method="POST" enctype="multipart/form-data">
            <?php
            $form = new \App\Form();
            $forum = new \Model\Forum();
            if(isset($_POST['submitted'])) {
                $forum_file = NULL;
                if(!empty($_POST['subject']) AND !empty($_POST['content'])) {
                    if(strlen($_POST['subject']) <= 255) {
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
                                    $path = 'public/media/forum/img/'. $_POST['subject'] . '-' . date('d-m-Y') . '.' . $type;
                                    $file_upload = move_uploaded_file($tmp_name, $path);
                                    if($file_upload) {
                                        $forum_file = $path;
                                    }
                                } else {
                                    $erreur = "Votre fichier doit ếtre au format (jpg, jpeg, png, gif)";
                                }
                            } else {
                                $erreur = "Votre fichier ne doit pas dépasser 2Mo";
                            }
                        }
                        $forum->insert($_SESSION['id'], $_POST['subject'], $_POST['content'], $forum_file);
                        $success = "Votre topic a été publié avec succès !";
                    } else {
                        $error = "Le titre du topic ne doit pas dépasser 255 caractères !";
                    }
                } else {
                    $error = "Veuillez remplir le topic SVP !";
                }
            }
            ?>
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><span class="font-weight-bold">Publier un article</span></div>
                    <div class="collapsible-body">
                        <div class="input-field">
                            <?php
                            $form->input("text", "subject", "subject", "validate", "255");
                            $form->label("subject", "Sujet du topic");
                            ?>
                        </div>
                        <div class="input-field">
                            <?php
                            $form->textarea("content", "content");
                            $form->label("content", "Contenu du topic");
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
                            <?php
                            $form->btn("submit", "submitted", "Poster le topic", '"btn btn-success font-weight-bold w-100"');
                            ?>
                        </div>
                        <?php
                        $form->get_error(isset($error)? $error : NULL);
                        $form->get_success(isset($success)? $success : NULL);
                        ?>
                    </div>
                </li>
            </ul>
        </form>
        <table class="table">
            <tbody>
            <?php
            // Paginator
            $article_per_page = 10;
            $total_article = $forum->rowCount();
            $total_page = ceil($total_article / $article_per_page);
            if(isset($_GET['index']) AND !empty($_GET['index'])) {
                $_GET['index'] = intval($_GET['index']);
                $current_page = $_GET['index'];
            } else {
                $current_page = 1;
            }
            $start = ($current_page - 1) * $article_per_page;
            if(!empty($forum->findAll())) {
                foreach ($forum->findAll("ORDER BY id DESC LIMIT $start, $article_per_page") as $datas): ?>
                    <tr>
                        <td>
                            <h1 class="title d-inline"><a href="index.php?page=forum&&action=show&&id=<?= $datas['id'] ?>"><?= $datas['subject'] ?></a></h1>
                            <?php
                            if($datas['resolved'] == 1) { ?>
                                <span class="float-right bg-success p-2 text-light">Résolu</span>
                                <?php
                            } else { ?>
                                <span class="float-right bg-danger p-2 text-light">Non résolu</span>
                                <?php
                            }
                            ?>
                            <span class="text-muted small d-block"><?= time_elapsed_string($datas['pub_date']) ?>
                                <?php
                                $comment = new \Model\Comment();
                                echo '('. count($comment->findBy(2, $datas['id'])) .' Commentaire(s))';
                                ?>
                            </span>
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
        <div class="offset-4 col-4">
            <ul class="pagination pagination-sm">
                <?php
                if($current_page != 1){ ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=forum&&index=<?= $current_page - 1 ?>">&laquo;</a>
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
                            <a class="page-link" href="index.php?page=forum&&index=<?= $i ?>"><?= $i ?><span class="sr-only">(current)</span></a>
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
                    <a class="page-link" href="index.php?page=forum&&index=<?= $current_page + 1 ?>">&raquo</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>