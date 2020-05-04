<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    require_once 'include/header.php';
    require_once  'include/aside.php';
    require_once '../models/Chat.php';
    $chat = new \Model\Chat();

    // Form submitted
    if(isset($_POST['submitted'])) {
        if(!empty($_POST['message'])) {
            $chat->insert($_SESSION['id'], $_POST['message']);
            $success = "Message envoyé avec succès";
        } else {
            $erreur = "Vous ne pouvez pas envoyé en message vide !";
        }
    }
    ?>
    <div class="col-12 col-lg-9 col-xl-9">
        <h3 class="text-center font-weight-bold">Discussion générale</h3>
        <div class="col-12">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <form method="POST">
                        <?php
                        require_once '../libraries/Form.class.php';
                        $form = new Form();
                        ?>
                        <div class="form-group">
                            <?php $form->textarea("message", "form-control", "message", "Écrire un message ...", "5"); ?>
                        </div>
                        <div class="form-group">
                            <?php $form->btn("submit", "submitted", "Envoyer le message", '"btn btn-success w-100"'); ?>
                        </div>
                        <?php $form->get_error(isset($erreur)? $erreur : NULL); ?>
                        <?php $form->get_success(isset($success)? $success : NULL); ?>
                    </form>
                </div>
                <div class="d-none d-lg-inline d-xl-inline col-4 bg-light">
                    <div class="font-weight-bold text-center bg-primary text-light p-2">Utilisateurs connectés (6)</div>
                        <ul>
                            <li>@maicam23</li>
                            <li>@maicam23</li>
                            <li>@maicam23</li>
                            <li>@maicam23</li>
                        </ul>
                </div>
            </div>
        </div>
        <table class="table">
            <tr id="chat">
                <?php
                    if(!empty($chat->findAll())) {
                        foreach ($chat->findAll("INNER JOIN users ON users.id = chat.users_id ORDER BY send_date DESC LIMIT 0, 15") as $donnees): ?>
                            <td class="row">
                                <?php
                                if($_SESSION['id'] == $donnees['users_id']) { ?>
                                 <span class="font-weight-bold">Moi:</span>
                                <?php
                                } else { ?>
                                 <span class="font-weight-bold"><a href="ecrire_message.php?id=<?= $donnees['users_id'] ?>" class="text-decoration-none">@<?= $donnees['username'] ?>:</a></span>
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
            </tr>
        </table>
    </div>
<?php
    require_once 'include/footer.php';
} else {
    header("Location: ../index.php");
}