<?php
session_start();
require_once "../models/Chat.php";
require_once "../libraries/utils.php";
$chat = new \Model\Chat();
if(!empty($chat->findAll())) {
    foreach ($chat->findAll("INNER JOIN users ON users.id = chat.users_id ORDER BY send_date DESC LIMIT 0, 15") as $datas): ?>
        <ol class="list-unstyled messages overflow-auto small">
            <?php
            if($_SESSION['id'] == $datas['id']) { ?>
                <li class="me">
                    <div class="message teal white-text col-lg-6 col-md-6 col-sm-8">
                        <?= $datas['content'] ?>
                    </div>
                    <time><?= time_elapsed_string($datas['send_date']) ?></time>
                </li>
                <!--<div class="chip">
                    <img src="public/media/img/profile.jpg" alt="Contact Person">
                    <span class="font-weight-bold">Moi:</span>
                    <span class="ml-2"><?= nl2br($datas['content']); ?></span>
                    <small><?= $datas['send_date']; ?></small>
                </div> -->
                <?php
            } else { ?>
                <li class="dest">
                    <div class="message_dest blue-grey white-text col-lg-6 col-md-6 col-sm-8">
                        <img class="rounded-circle responsive-img" src="<?= $datas['profile'] ?>" width="30" alt="<?= $datas['username'] ?>">
                        <span class="font-weight-bold"><a class="white-text small" href="index.php?page=read_message&&id=<?= $datas['users_id'] ?>"><?= $datas['username'] ?></a>:</span>
                        <?= $datas['content'] ?>
                    </div>
                    <time class="d-block"><?= time_elapsed_string($datas['send_date']) ?></time>
                </li>
                <?php
            }
            ?>
        </ol>
    <?php
    endforeach;
} else { ?>
    <div class="row">Pas de message dans le salon de chat ...</div>
    <?php
}
?>