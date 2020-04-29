<?php
// Démarrage de la session
session_start();
// Initialisation de la session
$_SESSION = array();
// Destruction de la session
session_destroy();
// Rédirection
header('Location: ../index.php');