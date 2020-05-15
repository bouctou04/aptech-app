<!DOCTYPE html>
<html>
    <head>
        <!-- <base href="/aptech-app/"> -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="/profile.png" />
        <link rel="stylesheet" type="text/css" href="/public/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/public/css/materialize.css">
        <link rel="stylesheet" type="text/css" href="/public/font/css/all.css">
        <link rel="stylesheet" type="text/css" href="/public/css/style.css">
        <title><?= $page_title; ?> | APTECH</title>
    </head>
<body>
<?php
$user = new \Model\User();
$user_online = $user->online($_SESSION['id']);
?>
    <nav>
        <div class="nav-wrapper teal">
            <a class="brand-logo right" href="index.php?page=home">APTECH</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><span class="material-icons"><i class="fa fa-bars"></i></a>
            <ul class="left hide-on-med-and-down">
                <li>
                    <a class="" href="index.php?page=home"><span class="fa fa-home"></span> Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li>
                    <a href="index.php?page=profile&&id=<?= $_SESSION['id'] ?>"><span class="fa fa-user"></span> Profile</a>
                </li>
                <li>
                    <a href="index.php?page=message"><span class="fa fa-envelope"></span> Message</a>
                </li>
                <li>
                    <a href="index.php?page=chat"><span class="fa fa-comments"></span> Chat</a>
                </li>
                <?php
                if($_SESSION['category_id'] == 1) { ?>
                    <li>
                        <a href="index.php?page=register"><span class="fa fa-user-plus"></span> Ajouter un utilisateur</a>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <a href="index.php?page=forum"><span class="fa fa-smile"></span> Forum</a>
                </li>
                <li>
                    <a href="index.php?page=followers"><span class="fa fa-users"></span> Membres</a>
                </li>
                <li>
                    <a class="dropdown-trigger" data-target='notification-lg' href="#"><span class="fa fa-bell"></span> Notifications</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Dropdown Structure -->
    <ul id='notification-lg' class='dropdown-content p-3'>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
    </ul>
    <ul id='notification-sm' class='dropdown-content p-3'>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
        <li><a href="">Baba Maiga a participé à votre topic</a></li>
    </ul>

    <ul class="sidenav" id="mobile-demo">
        <li>
            <a href="index.php?page=home"><span class="fa fa-home"></span> Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li>
            <a href="index.php?page=profile&&id=<?= $_SESSION['id'] ?>"><span class="fa fa-user"></span> Profile</a>
        </li>
        <li>
            <a href="index.php?page=message"><span class="fa fa-envelope"></span> Message</a>
        </li>
        <li>
            <a href="index.php?page=chat"><span class="fa fa-comments"></span> Chat</a>
        </li>
        <?php
        if($_SESSION['category_id'] == 1) { ?>
            <li>
                <a href="index.php?page=register"><span class="fa fa-user-plus"></span> Ajouter un utilisateur</a>
            </li>
            <?php
        }
        ?>
        <li>
            <a href="index.php?page=forum"><span class="fa fa-smile"></span> Forum</a>
        </li>
        <li>
            <a href="index.php?page=followers"><span class="fa fa-users"></span> Membres</a>
        </li>
        <li>
            <a class="dropdown-trigger" data-target='notification-sm' href="#"><span class="fa fa-bell"></span> Notifications</a>
        </li>
    </ul>



    <div class="container-fluid">
        <div class="row">
            <div class="col s5">
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><span class="fa fa-search"></span></div>
                        <div class="collapsible-body">
                            <?php
                            if(isset($_GET['search'])) {
                                redirectTo('index.php?page=search&&ss='. $_GET['search']);
                            }
                            ?>
                            <form method="GET" action="index.php?page=search" class="">
                                <div class="input-field">
                                    <input type="search" id="search" name="search" class="validate">
                                    <label for="search"><span class="fa fa-search"></span> Rechercher une personne ...</label>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="">
                <div class="input-field">
                    <a href="#" data-target="slide-out" class="sidenav-trigger btn-floating pulse right"><i class="fa fa-user"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php
$user = new \Model\User();
foreach ($user->find($_SESSION['id']) as $datas): ?>
    <ul id="slide-out" class="sidenav teal">
        <li><div class="user-view">
                <div class="background">
                    <img src="media/img/">
                </div>
                <a href="#user"><img class="circle" src="<?= $datas['profile'] ?>"></a>
                <a href="#name"><span class="white-text name font-weight-bold"><?= $_SESSION['first_name'] . ' ' . $_SESSION['last_name']?></span></a>
                <a href="#email"><span class="white-text email">@<?= $_SESSION['username'] ?></span></a>
            </div></li>
        <li><a class="waves-effect white-text" href="index.php?page=profile&&id=<?= $_SESSION['id'] ?>"><span class="fa fa-user"></span> Afficher mon profile</a></li>
        <li><a class="waves-effect white-text" href="#!"><span class="fa fa-pen"></span> Editer mon profile</a></li>
        <li><a class="waves-effect white-text" href="index.php?page=space"><span class="fa fa-border-style"></span> Mon espace</a></li>
        <li><div class="divider"></div></li>
        <li><a class="waves-effect white-text" href="index.php?page=logout"><span class="fa fa-sign-out-alt"></span> Se déconnecter</a></li>
    </ul>
<?php
endforeach;
?>

    <section class="container-lg row">
        <?= $page_content; ?>
    </section>
    <footer class="page-footer white bottom-sheet mt-4">
        <div class="col-12">
            <p class="text-center text-muted">&copy; 2020 - Mon app</p>
        </div>
    </footer>

    <!-- Begin Script Import -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/popper.js"></script>
    <script src="/public/js/bootstrap.js"></script>
    <script src="/public/js/materialize.js"></script>
    <script src="/public/js/app.js"></script>
    <script>
        setInterval('load_chat()', 500);
        function load_chat() {
            $('#chat').load('views/load_chat.php');
        }
        setInterval('load_message()', 1000);
        function load_message() {
            $('#loadMessage').load();
        }

        //setInterval('load_inline()', 500);
        function inline() {
            //$('#inline').load('include/en_ligne.php');
        }

        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.collapsible').collapsible();
            $('.modal').modal();
            $('.datepicker').datepicker();
            $('select').formSelect();
            $('input#input_text, input#subject, textarea#message, textarea#textarea2').characterCounter();
            $('.tabs').tabs();
            $('.dropdown-trigger').dropdown({
                'coverTrigger': false,
                'constrainWidth': false,
            });
        });

        // 	setInterval('load_messages()', 500);
        // function load_messages() {
        // 	$('#messages').load('include/load_messages.php');
        // 	}
    </script>
    <!-- End Script Import -->
</body>
</html>