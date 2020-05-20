<?php
session_start();
?>
<div class="nav-wrapper teal">
    <?php
    require_once '../../models/School.php';
    require_once '../../models/Message.php';
    $school = new \Model\School();
    $message = new \Model\Message();
    ?>
    <a class="brand-logo right" href="index.php?page=home"><?= $school->find($_SESSION['school_id'])[0]['acronym'] ?></a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger">
                <span class="material-icons"><i class="fa fa-bars"></i>
                    <?php
                    if($message->getUnread($_SESSION['id']) > 0) { ?>
                        <span class="red new badge"><?= $message->getUnread($_SESSION['id']) ?></span>
                        <?php
                    }
                    ?>
    </a>
    <ul class="left hide-on-med-and-down">
        <li>
            <a class="" href="index.php?page=home"><span class="fa fa-home"></span> Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li>
            <a href="index.php?page=profile&&id=<?= $_SESSION['id'] ?>"><span class="fa fa-user"></span> Profile</a>
        </li>
        <li id="menu-unread">
            <a href="index.php?page=message">
                <span class="fa fa-envelope"></span> Message
                <?php
                if($message->getUnread($_SESSION['id']) > 0) { ?>
                    <span class="red new badge"><?= $message->getUnread($_SESSION['id']) ?></span>
                    <?php
                }
                ?>
            </a>
        </li>
        <li>
            <a href="index.php?page=chat"><span class="fa fa-comments"></span> Chat</a>
        </li>
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