<?php
session_start();
require_once "../../models/Message.php";
$message = new \Model\Message();
var_dump($_GET);
?>
<ol class="list-unstyled messages">
    <?php
    if (!empty($message->findAllVisible($_SESSION['id'], $sender_id))) {
        foreach ($message->findAllVisible($_SESSION['id'], $sender_id) as $datas):
            if($datas['sender_id'] == $_SESSION['id']) { ?>
                <li class="me">
                    <div class="message teal white-text col-6">
                        <?= $datas['content'] ?>
                    </div>
                    <time><?= time_elapsed_string($datas['send_date']) ?></time>
                </li>
                <?php
            } else { ?>
                <li class="dest">
                    <div class="message_dest blue-grey white-text col-6">
                        <?= $datas['content'] ?>
                    </div>
                    <time><?= time_elapsed_string($datas['send_date']) ?></time>
                </li>
                <?php
            }
        endforeach;
    } else {
        echo "Vous n'avez pas encore de message !";
    }
    ?>
</ol>