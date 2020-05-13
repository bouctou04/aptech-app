<?php

function autoload($class_name) {
    $class_name = str_replace("Model\\", "", $class_name);
    require 'models/'. $class_name . '.php';
}

function render($url, $variables = []) {

    extract($variables);

    ob_start();

    switch ($url){
        case 'home':
            if(isset($_GET['action']) AND $_GET['action'] === 'show' && isset($_GET['id'])) {
                $page_title = "Article";
                require_once 'views/article_show.php';
            } else {
                $page_title = "Accueil";
                require_once 'views/home.php';
            }
            break;
        case 'profile':
            $page_title = "Profile";
            require_once 'views/profile.php';
            break;
        case 'message':
            $page_title = "Message";
            require_once 'views/message.php';
            break;
        case 'chat':
            $page_title = "Chat";
            require_once 'views/chat.php';
            break;
        case 'register':
            $page_title = "Inscription";
            require_once 'views/register.php';
            break;
        case 'forum':
            if(isset($_GET['action']) AND $_GET['action'] == 'show' AND isset($_GET['id'])) {
                $page_title = "Forum";
                require_once 'views/forum_show.php';
            } else {
                $page_title = "Forum";
                require_once 'views/forum.php';
            }
            break;
        case 'followers':
            $page_title = "Abonnés";
            require_once 'views/followers.php';
            break;
        case 'notification':
            $page_title = "Notifications";
            require_once 'views/notification.php';
            break;
        case 'maintenance':
            $page_title = "En cours de construction";
            require_once 'views/maintenance.php';
            break;
        case 'logout':
            require_once 'views/logout.php';
            break;
        case 'search':
            $page_title = "Recherche";
            require_once 'views/search.php';
            break;
        case 'read_message':
            $page_title = "Message";
            require_once 'views/read_message.php';
            break;
        case 'space':
            if($_SESSION['category_id'] == 1) {
                $page_title = 'Espace administration';
                require_once 'views/admin_space.php';
            } elseif ($_SESSION['category_id'] == 2) {
                $page_title = 'Espace professeur';
                require_once 'views/teacher_space.php';
            } elseif ($_SESSION['category_id'] == 3) {
                $page_title = 'Espace étudiant';
                require_once 'views/student_space.php';
            } else {
                require_once 'views/404.php';
            }
            break;
        default:
            $page_title = "404 Page non trouvée !";
            require_once 'views/404.php';
    }

    $page_content = ob_get_clean();

    require_once "views/templates/default_layout.php";
}

function redirectTo(string $path) {
    header("Location: $path");
    exit();
}

