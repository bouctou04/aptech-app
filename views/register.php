<?php
if($_SESSION['id'] == 1) {
    $user = new \Model\User();
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
    } ?>
    <div class="col-12">
        <h1 class="title mt-n3 font-weight-bold">Inscription</h1>
        <div class="col-12">
            <div class="">
                <div class="">
                    <div class="<?= $etape2 ?> form-group">
                        <a href="index.php?page=register" class="waves-effect waves-light btn grey btn-sm">
                            <span class="fa fa-chevron-circle-left"></span> Précedent
                        </a>
                    </div>
                    <div class="form-group">
                        <a href="index.php?page=register&&etape1=administrator" class="<?= $etape1 ?> btn btn-primary w-100 font-weight-bold">Ajouter un(e) adminstrateur</a>
                    </div>
                    <div class="form-group">
                        <a href="index.php?page=register&&etape1=teacher" class="<?= $etape1 ?> btn btn-primary w-100 font-weight-bold">Ajouter un(e) professeur</a>
                    </div>
                    <div class="form-group">
                        <a href="index.php?page=register&&etape1=student" class="<?= $etape1 ?> btn btn-primary w-100 font-weight-bold">Ajouter un(e) Etudiant(e)</a>
                    </div>
                </div>
                <div>
                    <form method="POST">
                        <?php
                        if(isset($_POST['submitted'])) {
                            if(!empty($_POST['last_name']) AND !empty($_POST['first_name'])AND !empty($_POST['birth_date']) AND !empty($_POST['sexe']) AND !empty($_POST['mail'])) {
                                if($user->verifyUsername('p') == false) {
                                    if($user->verifyEmail($_POST['mail']) == false) {
                                        if($_POST['mail'] == $_POST['mail_confirm']) {
                                            $user->insert(get_user_category($_GET['etape1']), $_SESSION['school_id'], $_POST['last_name'], $_POST['first_name'], $_POST['birth_date'], $_POST['sexe'], $_POST['mail']);
                                        } else {
                                            $error = "Les adresses mails ne correspondent pas !";
                                        }
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
                        <div class="<?= $etape2 ?> text-center"><h3 class="title">Renseigner les coordonnées de l'utilisateur</h3></div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="<?= $etape2 ?>input-field">
                                    <?php
                                    $form->input("text", "last_name", "last_name", "validate", "10");
                                    $form->label("last_name", "Nom de famille");
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="<?= $etape2 ?>input-field">
                                    <?php
                                    $form->input("text", "first_name", "first_name", "validate");
                                    $form->label("first_name", "Prénom");
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="<?= $etape2 ?>input-field">
                                    <?php
                                    $form->input("date", "birth_date", "birth_date", "validate");
                                    $form->label("birth_date", "Date de naissance");
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="<?= $etape2 ?>input-field">
                                    <select name="sexe" id="sexe">
                                        <option value="" disabled selected>Selectionner le sexe</option>
                                        <option value="M">Homme</option>
                                        <option value="F">Femme</option>
                                    </select>
                                    <?php
                                    $form->label("sexe", "Sexe");
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="<?= $etape2 ?>input-field">
                                    <?php
                                    $form->input("email", "mail", "mail", "validate");
                                    $form->label("mail", "Adresse email");
                                    ?>
                                    <span class="helper-text" data-error="Mauvais adresse email" data-success="Format d'adresse valide"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="<?= $etape2 ?>input-field">
                                    <?php
                                    $form->input("email", "mail_confirm", "mail_confirm", "validate");
                                    $form->label("mail_confirm", "Confirmation d'adresse email");
                                    ?>
                                    <span class="helper-text" data-error="Mauvais adresse email" data-success="Format d'adresse valide"></span>
                                </div>
                            </div>
                        </div>

                        <?php
                        if(isset($_GET['etape1']) AND $_GET['etape1'] == 'student') {

                            ?>
                            <hr>
                            <div class="<?= $etape2 ?> text-center">
                                <div class="title">Informations complémentaires de l'étudiant</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="<?= $etape2 ?>input-field">
                                        <select name="filiere" id="filiere">
                                            <option value="" disabled selected>Selectionner la filière</option>
                                        </select>
                                        <?php
                                        $form->label("filiere", "Filière");
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="<?= $etape2 ?>input-field">
                                        <select name="niveau" id="niveau">
                                            <option value="" disabled selected>Selectionner le niveau</option>
                                        </select>
                                        <?php
                                        $form->label("niveau", "Niveau");
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="<?= $etape2 ?>input-field">
                                        <select name="periode" id="niveau">
                                            <option value="" disabled selected>Selectionner la période</option>
                                        </select>
                                        <?php
                                        $form->label("periode", "Période");
                                        ?>
                                    </div>
                                </div>
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
    redirectTo("index.php?page=error");
}