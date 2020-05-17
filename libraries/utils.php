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
                if(!empty($_GET['controller'])) {
                    $action = $_GET['controller'];
                } else {
                    $action = 'index';
                }
                ob_start();
                switch ($action) {
                    case 'register':
                        require_once 'views/space/admin/register.php';
                        break;
                    case 'index':
                        require_once 'views/space/admin/index.php';
                        break;
                    case 'internal':
                        require_once 'views/space/admin/internal.php';
                        break;
                    case 'payment':
                        require_once 'views/space/admin/payment.php';
                        break;
                    case 'course':
                        require_once 'views/space/admin/course.php';
                        break;
                    default:
                        require_once 'views/space/admin/index.php';
                }
                $content = ob_get_clean();
                require_once 'views/space.php';
            } elseif ($_SESSION['category_id'] == 2) {
                $page_title = 'Espace professeur';
                ob_start();
                if(!empty($_GET['controller'])) {
                    $action = $_GET['controller'];
                } else {
                    $action = 'index';
                }
                ob_start();
                switch ($action) {
                    case 'index':
                        require_once 'views/space/teacher/index.php';
                        break;
                    default:
                        require_once 'views/space/teacher/index.php';
                }
                $content = ob_get_clean();
                require_once 'views/space.php';
            } elseif ($_SESSION['category_id'] == 3) {
                $page_title = 'Espace étudiant';
                ob_start();
                if(!empty($_GET['controller'])) {
                    $action = $_GET['controller'];
                } else {
                    $action = 'index';
                }
                ob_start();
                switch ($action) {
                    case 'index':
                        require_once 'views/space/student/index.php';
                        break;
                    case 'payment':
                        require_once 'views/space/student/payment.php';
                        break;
                    default:
                        require_once 'views/space/student/index.php';
                }
                $content = ob_get_clean();
                require_once 'views/space.php';
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

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'année',
        'm' => 'mois',
        'w' => 'semaine',
        'd' => 'jour',
        'h' => 'heure',
        'i' => 'minute',
        's' => 'seconde',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}