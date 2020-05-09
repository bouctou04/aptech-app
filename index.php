<?php
session_start();
require_once "libraries/utils.php";
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
require_once "libraries/Form.php";
$form = new \App\Form();

spl_autoload_register('autoload');

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}

render($page, compact('form'));
} else {
    redirectTo("login.php");
}