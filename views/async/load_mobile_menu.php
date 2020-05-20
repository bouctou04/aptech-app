<?php
session_start();
require_once "../../models/Message.php";
$message = new \Model\Message();
?>
<li>
    <a href="index.php?page=home"><span class="fa fa-home"></span> Accueil <span class="sr-only">(current)</span></a>
</li>
<li>
    <a href="index.php?page=profile&&id=<?= $_SESSION['id'] ?>"><span class="fa fa-user"></span> Profile</a>
</li>
<li>
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
    <a class="dropdown-trigger" data-target='notification-sm' href="#"><span class="fa fa-bell"></span> Notifications</a>
</li>