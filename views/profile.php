<div class="col-12">
    <?php
    $user = new \Model\User();
    if(!empty($_GET['id']) AND $_GET['id'] > 0) {
        $getid = intval($_GET['id']);
        if($user->find($getid)) {
            foreach ($user->find($getid) as $datas): ?>
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <img src="<?= $datas['profile'] ?>" class="responsive-img rounded" alt="">
                        <?php
                        if($_SESSION['id'] == $getid) { ?>
                            <a class="waves-effect waves-light modal-trigger" href="#profil"><span class="fa fa-pen"></span> Modifier la photo</a>
                            <div id="profil" class="modal">
                                <div class="modal-content">
                                    <h4>Selectionner une photo de profil</h4>
                                    <?php
                                    if(isset($_POST['edited'])) {
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
                                                    $path = 'public/media/profile/'. $_SESSION['id']. '.' . $type;
                                                    $file_upload = move_uploaded_file($tmp_name, $path);
                                                    if($file_upload) {
                                                        $user->setProfil($_SESSION['id'], $path);
                                                    }
                                                } else {
                                                    $erreur = "Votre fichier doit ếtre au format (jpg, jpeg, png, gif)";
                                                }
                                            } else {
                                                $erreur = "Votre fichier ne doit pas dépasser 2Mo";
                                            }
                                        }
                                    }
                                    ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Image</span>
                                                <?php $form->input("file", "file-input"); ?>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <?php $form->input("text", "file", "file", "file-path validate", NULL, '"Importer une image (facultatif)"'); ?>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn indigo lighten-5 black-text" data-dismiss="modal">Annuler</button>
                                            <button type="submit" name="edited" class="btn btn-success">Engregister</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-8">
                        <h1 class="title mt-n1"><?= $datas['first_name']. ' '. $datas['last_name'] ?></h1>
                        <div>
                            <ol class="list-unstyled">
                                <li class=""><span class="text-muted">Adresse email: </span> <?= $datas['email'] ?></li>
                                <li class=""><span class="text-muted">Nom d'utilisateur: </span> <?= $datas['username'] ?> <?php
                                    if($_SESSION['id'] == $getid) {
                                        echo "<a href='index.php?page=maintenance'>Modifier</a>";
                                    }
                                    ?></li>
                                <li class=""><span class="text-muted">Date de naissance: </span> <?= $datas['birth_date'] ?></li>
                                <li class=""><span class="text-muted">Sexe: </span> <?php if($datas['sexe'] == 'M') { echo "Masculin"; }else{ echo "Féminin"; } ?></li>

                                <div class="border-top mt-2">
                                    <li class=""><span class="text-muted">Établissement: </span> Technolab ISTA Mali.</li>
                                    <li class=""><span class="text-muted">Catégorie: </span> Étudiant</li>
                                    <li class=""><span class="text-muted">Niveau d'étude: </span> Licence</li>
                                    <li class=""><span class="text-muted">Filière: </span> Génie Lociel</li>
                                    <li class=""><span class="text-muted">Période: </span> 2019 - 2020</li>
                                </div>
                            </ol>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            if($_SESSION['id'] != $getid) { ?>
                <div class="">
                    <a class="btn" href="index.php?page=read_message&&id=<?= $getid ?>"><span class="fa fa-envelope"></span> Message</a>
                </div>
             <?php
            }
            ?>
                <section>
                <table>
                <h1 class="title center">Fil d'activités</h1>
                <tbody>
                <?php
            $forum = new \Model\Forum();
            $actu = $forum->findAll("WHERE users_id = ". $getid. " ORDER BY id DESC");
            if(!empty($actu)) {
                foreach ($actu as $datas): ?>
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
            } else {
                echo "Vous n'avez pas encore de données à afficher !";
            }
            ?>
            </tbody>
            </table>
            </section>
    <?php
        } else {
            redirectTo("index.php?page=error");
        }
    } else {
        redirectTo("index.php?page=error");
    }
    ?>
</div>