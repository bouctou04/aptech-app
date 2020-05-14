<link rel="stylesheet" href="public/css/bootstrap.css">
<link rel="stylesheet" href="public/css/materialize.css">
<link rel="stylesheet" href="public/css/style.css">

<style>
    .message {
        background: #017fff;
        color: white;
        float: right;
        border-radius: 2rem 2rem 0 2rem;
        padding: 0.8rem;
    }
    .messagel {
        background: #017fff;
        color: white;
        float: left;
        border-radius: 0 2rem 2rem 2rem;
        padding: 0.8rem;
    }
    ol {
        padding: 2rem;
    }
    .message li {
        clear: both;
        margin-bottom: 2rem;
    }
</style>
<?php
$last_name = "Maoni";
$first_name = "Madani";
$username = "Madama";
$email = "mama@ff.com";
$passwordn = "kkzdkkda";
$message = "
<html>
<body  style='background: #eeeeee; margin-left: 130px; margin-right: 130px;'>
<header>
    <div style='text-align: center; font-weight: bold'><a href='#'>aptechapp-com</a></div>
</header>
<h1 style='background: #009688; color: white; padding: 12px; font-size: 18px; text-align: center; font-weight: bold;'>Bravo $last_name $first_name Vous avez été inscris avec succès sur aptechapp.com</h1>
<section style='background: #FFFFFF; padding: 2rem;'>
    <p>Salut <b>$first_name</b> <b>$last_name</b>, <br> 
    vous venez d'être membre de la plateforme aptechapp. Ce mail est confidentiel, il contient vos identifiants de connexion, vous devez alors le gardé en sécurité !</p>
    <p>Vos identifiants sont les suivants: <br> Email: <b>$email</b> <br> Identifiant: <b>$username</b> <br> Mot de passe: <b>$passwordn</b></p>
    <p>Connectez-vous avec vos identifiants sur: <span style='background: #009688; padding: 2px; color: #FFFFFF'><a href='https://aptech-app-2.000webhostapp.com/' style='color: white'>aptech.com</a></span></p>
    <p>Vous pouvez changer votre mot de passe et votre identifiant une fois connecté.</p>
    <p>Sachez qu'il n'est pas nécessaire de répondre à ce mail.</p>
</section>
</body>
</html>
";

echo $message; ?>

<script src="public/js/jquery.js"></script>
<script src="public/js/popper.js"></script>
<script src="public/js/bootstrap.js"></script>
<script src="public/js/materialize.js"></script>