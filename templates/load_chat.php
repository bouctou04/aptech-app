<?php
session_start();
require_once '../models/Chat.php';
$chat = new \Model\Chat();
if(!empty($chat->findAll())) {
    foreach ($chat->findAll("INNER JOIN users ON users.id = chat.users_id ORDER BY send_date DESC LIMIT 0, 15") as $donnees): ?>
        <div class="">
            <?php
                if($_SESSION['id'] == $donnees['id']) { ?>
                    <div class="chip">
                        <img src="media/img/profile.jpg" alt="Contact Person">
                        <span class="font-weight-bold">Moi:</span>
                        <span class="ml-2"><?= nl2br($donnees['content']); ?></span>
                        <small><?= $donnees['send_date']; ?></small>
                    </div>
                <?php
                } else { ?>
                    <div class="chip">
                        <img src="media/img/profile.jpg" alt="Contact Person">
                        <span class="font-weight-bold"><a href="ecrire_message.php?id=<?= $donnees['users_id'] ?>"><?= $donnees['username'] ?></a>:</span>
                        <span class="ml-2"><?= nl2br($donnees['content']); ?></span>
                        <small class="text-muted"><?= $donnees['send_date']; ?></small>
                    </div>
                <?php
                }
            ?>
        </div>
    <?php
    endforeach;
} else { ?>
    <div class="row">Pas de message dans le salon de chat ...</div>
    <?php
}
?>