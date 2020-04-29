<?php


ob_start();
$page_title = "Mon application";
require_once 'templates/pages/article.php';
$page_content = ob_get_clean();

require_once 'templates/layout.php';