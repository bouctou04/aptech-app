<?php
require 'model/User.php';

$user = new \model\User();

$utilisateur = $user->findAll();

foreach ($utilisateur as $u) {
    var_dump($u);
}