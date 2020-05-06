<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    require_once 'include/header.php';
    require_once '../models/Chat.php';
    $chat = new \Model\Chat();

    // Form submitted
    if(isset($_POST['submitted'])) {
        if(!empty($_POST['message'])) {
            if(strlen($_POST['message']) <= 255) {
                $chat->insert($_SESSION['id'], $_POST['message']);
                $success = "Message envoyé avec succès";
            }else {
                $erreur = "Votre message ne doit pas dépasser 255 caractères !";
            }
        } else {
            $erreur = "Vous ne pouvez pas envoyé en message vide !";
        }
    }
    ?>
    <div class="col-12 col-lg-8">
        <h1 class="title mt-n3 font-weight-bold">Salon de chat</h1>
        <div class="col-12">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <form method="POST">
                        <?php
                        require_once '../libraries/Form.class.php';
                        $form = new Form();
                        ?>
                        <div class="input-field">
                            <?php
                            $form->textarea("message", "message", "materialize-textarea", "255");
                            $form->label("message", "<span class='fa fa-envelope'></span> Écrivez votre message ici ...");
                            ?>
                        </div>
                        <div class="input-field">
                            <?php $form->btn("submit", "submitted", "Envoyer", '"btn left"'); ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <div id="chat">
                <?php
                    if(!empty($chat->findAll())) {
                        foreach ($chat->findAll("INNER JOIN users ON users.id = chat.users_id ORDER BY send_date DESC LIMIT 0, 30") as $donnees): ?>
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
            </div>
    </div>
    <div class="d-none d-lg-inline d-xl-inline col-4">
        <div class="font-weight-bold text-center teal text-light p-2">Utilisateurs connectés (6)</div>
        <ul>
            <li>@maicam23</li>
            <li>@maicam23</li>
            <li>@maicam23</li>
            <li>@maicam23</li>
        </ul>
    </div>
<?php
    require_once 'include/footer.php';
} else {
    header("Location: ../index.php");
}