<?php
session_start();
require_once '../models/Chat.php';
$chat = new \Model\Chat();
if(!empty($chat->findAll())) {
    foreach ($chat->findAll("INNER JOIN users ON users.id = chat.users_id ORDER BY send_date DESC LIMIT 0, 15") as $donnees): ?>
        <td class="row">
            <?php
            if($_SESSION['id'] == $donnees['users_id']) { ?>
                <span class="font-weight-bold">Moi:</span>
                <?php
            } else { ?>
                <span class="font-weight-bold"><a href="ecrire_message.php?id=<?= $donnees['users_id'] ?>" class="text-decoration-none">@<?= $donnees['username'] ?></a>:</span>
                <?php
            }
            ?>
            <span class="text-muted pl-2"><?= nl2br($donnees['content']); ?></span>
            <span class="pl-3 opacity-1 small">Il y'a <?= $donnees['send_date']; ?></span>
        </td>
    <?php
    endforeach;
} else { ?>
    <td class="row">Pas de message dans le salon de chat ...</td>
    <?php
}
?>