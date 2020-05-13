<?php
session_start();
require_once "../models/Chat.php";
$chat = new \Model\Chat();
if(!empty($chat->findAll())) {
    foreach ($chat->findAll("INNER JOIN users ON users.id = chat.users_id ORDER BY send_date DESC LIMIT 0, 15") as $datas): ?>
        <ol class="list-unstyled messages">
            <?php
            if($_SESSION['id'] == $datas['id']) { ?>
                <li class="me">
                    <div class="message teal white-text col-6">
                        <?= $datas['content'] ?>
                    </div>
                    <time><?= $datas['send_date'] ?></time>
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
                    <div class="message_dest black white-text col-6">
                        <div class="chip black white-text">
                            <img src="public/media/img/profile.jpg" alt="Contact Person">
                            <span class="font-weight-bold"><a href="index.php?page=read_message&&id=<?= $datas['users_id'] ?>"><?= $datas['username'] ?></a>:</span>
                        </div>
                        <?= $datas['content'] ?>
                    </div>
                    <time class="d-block"><?= $datas['send_date'] ?></time>
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