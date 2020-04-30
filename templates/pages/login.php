<?php
    // Call to a Form class
    require_once 'libraries/Form.class.php';
    $form = new Form();

    // Form is submitted
    if(isset($_POST['run'])) {
        if(!empty($_POST['identifiant']) AND !empty($_POST['mot_de_passe'])) {
            require_once 'models/User.php';
            $user = new \Model\User();
            $login = $user->login($_POST['identifiant'], $_POST['mot_de_passe']);
            if($login === true) {

            } else {
                $erreur = "Mauvais identifiant";
            }
        } else {
            $erreur = "Veuillez vous authentifiez pour accéder au contenu de l'application !";
        }
    }
?>
<div class="container-fluid">
    <div class="row">
        <!-- <img src="media/img/background_02.gif" class="position-absolute h-100 w-100"> -->
        <div class="box offset-lg-3 offset-md-2 col-md-8 col-lg-6 col-sm-12 offset-md-2 offset-lg-3 mt-lg-10 bg-light shadow-lg p-4">
            <div class="mw-100 h1 display-3 text-center">
                <span class="fa fa-expand text-primary"></span>
            </div>
            <div class="h4 font-weight-bold text-center mb-4">
                Se connecter à son espace universitaire !
            </div>
            <div class="col-12 pt-4">
                <form class="form" method="POST">
                    <div class="form-group">
                        <?php $form->label('mail', 'Nom d\'utilisateur ou Adresse Mail', '"font-weight-bold h6"'); ?>
                        <?php $form->input('text', 'identifiant', 'mail', 'form-control', '"Nom d\'utilisateur"'); ?>
                    </div>
                    <div class="form-group">
                        <?php $form->label('mdp', 'Mot de passe', 'font-weight-bold h6'); ?>
                        <?php $form->input('password', 'mot_de_passe', 'mdp', 'form-control', '"Mot de passe"'); ?>
                    </div>
                    <div class="form-group">
                        <?php $form->label('en_ligne', 'Se souvenir de moi sur cet appareil', 'small'); ?>
                        <?php $form->input('checkbox', 'se_souvenir_de_moi', 'en_ligne', 'ml-2') ?>
                    </div>
                    <div class="form-group">
                        <?php $form->btn('submit', 'run', 'Se connecter', '"btn btn-primary w-100"'); ?>
                    </div>
                    <?php
                    if(isset($erreur)){ ?>
                        <div class="text-center alert alert-danger small">
                            <?= $erreur; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="text-center">
                        <a href="#">Mot de passe oublié ?</a>
                    </div>
                </form>
                <div class="row mt-4">
                    <div class="col-12 small d-inline">
                        <a href="#" class="text-dark p-2">Contact</a>
                        <a href="#" class="text-dark p-2">À propos</a>
                        <a href="#" class="text-dark p-2">Aide</a>
                        <a href="#" class="text-dark p-2">Politique de confidentialité</a>
                        <a href="#" class="text-dark p-2">Règles de gestion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>