<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    if($_SESSION['category_id'] == 1) {
        require_once '../models/User.php';
        $user = new \Model\User();
        require_once '../libraries/Form.class.php';
        $form = new Form();
        require_once 'include/header.php';
        require_once 'include/aside.php';

        /**
         * @param string $category
         * @return int
         */
        function get_user_category(string $category):int {
            if($category === 'administrator') {
                return 1;
            } elseif ($category === 'teacher') {
                return 2;
            } elseif ($category === 'student') {
                return 3;
            } else {
                return false;
            }
        }

        $etape_valide = array('administrator', 'teacher', 'student');
        $etape1 = '';
        $etape2 = 'invisible disabled';
        if(isset($_GET['etape1']) AND in_array($_GET['etape1'], $etape_valide)) {
            $etape1 = 'disabled';
            $etape2 = '';

        }
        ?>
        <div class="col-12 col-lg-9 col-xl-9">
            <h3 class="text-center font-weight-bold">Inscription</h3>
            <div class="col-12">
                <div class="container">
                    <div class="">
                        <div class="<?= $etape2 ?> form-group">
                            <a href="inscription.php" class="btn btn-secondary btn-sm">
                                <span class="fa fa-chevron-circle-left"></span> Révenir dans la selection des catégories
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="inscription.php?etape1=administrator" class="<?= $etape1 ?> btn btn-primary w-100 font-weight-bold">Ajouter un(e) gestionnaire</a>
                        </div>
                        <div class="form-group">
                            <a href="inscription.php?etape1=teacher" class="<?= $etape1 ?> btn btn-primary w-100 font-weight-bold">Ajouter un(e) professeur</a>
                        </div>
                        <div class="form-group">
                            <a href="inscription.php?etape1=student" class="<?= $etape1 ?> btn btn-primary w-100 font-weight-bold">Ajouter un(e) Etudiant(e)</a>
                        </div>
                    </div>
                    <div>
                        <form method="POST">
                            <?php
                            if(isset($_POST['submitted'])) {
                                if(!empty($_POST['last_name']) AND !empty($_POST['first_name'])AND !empty($_POST['birth_date']) AND !empty($_POST['sexe']) AND !empty($_POST['mail'])) {
                                    if($user->verifyUsername('p') == false) {
                                        if($user->verifyEmail($_POST['mail']) == false) {
                                            $user->insert(get_user_category($_GET['etape1']), $_SESSION['school_id'], $_POST['last_name'], $_POST['first_name'], $_POST['birth_date'], $_POST['sexe'], $_POST['mail']);
                                        } else {
                                            $error = "Adresse email existant";
                                        }
                                    } else {
                                        $error = "Username";
                                    }
                                    $success = "OK";
                                } else {
                                    $error = "Veuillez valider tous les champs";
                                }
                            }
                            ?>
                            <div class="<?= $etape2 ?> text-center"><h3 class="font-weight-bold">Renseigner les coordonnées de l'utilisateur</h3></div>
                            <div class="<?= $etape2 ?> form-group input-group">
                                <div class="input-group-prepend">
                                    <?php
                                    $form->label("last_name", "Nom et Prénom", "input-group-text");
                                    ?>
                                </div>
                                <?php
                                $form->input("text", "last_name", "last_name", "$etape2 form-control", '"Nom de famille"');
                                $form->input("text", "first_name", "last_name", "$etape2 form-control", "Prénom");
                                ?>
                            </div>

                            <div class="<?= $etape2 ?> form-group input-group">
                                <div class="input-group-prepend">
                                    <?php
                                    $form->label("birth_date", "Date Naiss. et Sexe", "input-group-text");
                                    ?>
                                </div>
                                <?php
                                $form->input("date", "birth_date", "birth_date", "$etape2 form-control");
                                ?>
                                <select class="form-control" name="sexe" id="" required>
                                    <option value="">Selectionner</option>
                                    <option value="M">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                            </div>

                            <div class="<?= $etape2 ?> form-group input-group">
                                <div class="input-group-prepend">
                                    <?php
                                    $form->label("mail", "Adresse e-mail", "input-group-text");
                                    ?>
                                </div>
                                <?php
                                $form->input("email", "mail", "mail", "$etape2 form-control", '"Adresse e-mail"');
                                ?>
                            </div>

                            <?php
                            if(isset($_GET['etape1']) AND $_GET['etape1'] == 'student') {

                                ?>
                                <hr>
                                <div class="<?= $etape2 ?> text-center"><h3 class="font-weight-bold">Informations complémentaires de l'étudiant</h3></div>
                                <div class="<?= $etape2 ?> form-group input-group">
                                    <div class="input-group-prepend">
                                        <?php
                                        $form->label("last_name", "Filière - Niveau - Période", "input-group-text");
                                        ?>
                                    </div>
                                    <select class="form-control" name="filiere" id="" required>
                                        <option value="">Selectionner la Filière</option>
                                    </select>
                                    <select class="form-control" name="niveau" id="" required>
                                        <option value="">Selectionner le niveau</option>
                                    </select>
                                    <select class="form-control" name="periode" id="" required>
                                        <option value="">Selectionner la période</option>
                                    </select>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="form-group">
                                <?php
                                $form->btn("submit", "submitted", "Enregistrer", "$etape2 'btn btn-primary w-100 font-weight-bold'");
                                ?>
                            </div>
                            <?php
                            if(isset($error)) { ?>
                                <div class="form-group">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Désolé une erreur s'est produite !</strong> <?= $error ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                <?php
                            } elseif(isset($success)) { ?>
                                <div class="form-group">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Enregistrement effectué !</strong> L'utilisateur peut désormais se connecter avec ses identifiants (Pseudonyme ou adresse email et son mot de passe).
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        header("Location: 404.php");
    }
} else {
    header("Location: ../index.php");
}