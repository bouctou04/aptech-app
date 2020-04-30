<?php
session_start();

$_SESSION['id'] = 2;

ob_start();
$page_title = "Mon application";
require_once 'templates/pages/login.php';
$page_content = ob_get_clean();

require_once 'templates/layout.php';