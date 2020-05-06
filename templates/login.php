<?php
session_start();

// If is set $_SESSION
if(!empty($_SESSION['user']) AND $_SESSION['user'] > 0) {
    header("Location: accueil.php");
}

// Include files
require_once '../libraries/Form.class.php';
$form = new Form();
$value_username = '';
$value_password = '';

if (isset($_COOKIE['username'], $_COOKIE['password'])) {
    $value_username = $_COOKIE['username'];
    $value_password = $_COOKIE['password'];
}

// Form submitted
if(isset($_POST['submitted'])) {
    if(!empty($_POST['username']) AND !empty($_POST['password'])) {
        if(isset($_POST['remember_me'])) {
            setcookie('username', $_POST['username'], time() + 365*24*3600, null, null, false, true);
            setcookie('password', $_POST['password'], time() + 365*24*3600, null, null, false, true);
        }
        // Include User class
        require_once '../models/User.php';
        $login = new \Model\User();
        if($login->login($_POST['username'], $_POST['password']) === true) {
            $_SESSION['id'] = $login->getId();
            $_SESSION['category_id'] = $login->getId();
            $_SESSION['school_id'] = $login->getSchoolId();
            $_SESSION['last_name'] = $login->getLastName();
            $_SESSION['first_name'] = $login->getFirstName();
            $_SESSION['username'] = $login->getUsername();
            $_SESSION['email'] = $login->getEmail();
            header("Location: accueil.php");
        } else {
            $erreur = "Les identifiants fournis ne correspondent à aucun compte dans nos fichiers, veuillez vérifier que ces informations sont correctes !";
        }
    } else {
        $erreur = "Veuillez renseigner vos identifiants !";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- <base href="/aptech-app/"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/templates/style/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/templates/style/css/materialize.css">
    <link rel="stylesheet" type="text/css" href="/templates/style/font/css/all.css">
    <link rel="stylesheet" type="text/css" href="/templates/style/css/style.css">
    <title></title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- <img src="media/img/background_02.gif" class="position-absolute h-100 w-100"> -->
        <div class="box offset-lg-3 offset-md-2 col-md-8 col-lg-6 col-sm-12 offset-md-2 offset-lg-3 mt-lg-10 bg-light shadow-lg p-4">
            <div class="mw-100 h1 display-3 text-center">
               <span class="fa fa-expand waves-effect teal-text"></span>
            </div>
            <div class="h4 font-weight-bold text-center mb-4">
                Se connecter à son espace universitaire !
            </div>
            <div class="col-12 pt-4">
                <form class="form" method="POST">
                    <div class="input-field">
                        <?php $form->input('text', 'username', 'mail', 'validate', NULL, NULL, $value_username); ?>
                        <?php $form->label('mail', 'Nom d\'utilisateur ou Adresse Mail'); ?>
                    </div>
                    <div class="input-field">
                        <?php $form->input('password', 'password', 'mdp', 'validate', NULL, NULL, $value_password); ?>
                        <?php $form->label('mdp', 'Mot de passe'); ?>
                    </div>
                    <div class="input-field">
                        <p>
                            <label>
                                <?php $form->input('checkbox', 'remember_me', 'remember') ?>
                                <span>Se souvenir de moi sur cet appareil.</span>
                            </label>
                        </p>
                    </div>
                    <div class="form-group">
                        <?php $form->btn('submit', 'submitted', 'Se connecter', '"waves-effect waves-light btn w-100"'); ?>
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
<script src="/templates/style/js/jquery.js"></script>
<script src="/templates/style/js/materialize.js"></script>
<script src="/templates/style/js/app.js"></script>
</body>
</html>