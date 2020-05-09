<?php
session_start();

$_SESSION = array();

session_destroy();

redirectTo("login.php");