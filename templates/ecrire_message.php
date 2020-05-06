<?php
session_start();
if(!empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
    if(!empty($_GET['id']) AND $_GET['id'] > 0) {
        $getid = intval($_GET['id']);
        if($_SESSION['id'] === $getid) {
            header("Location: accueil.php");
        }
        require_once '../models/Message.php';
        $message = new \Model\Message();

        require_once 'include/header.php';
        require_once '../libraries/Form.class.php';
         ?>
<div class="col-12">
    <h1 class="title font-weight-bold">Messages</h1>
    <div class="col-12">
        <form method="POST">
            <?php
            $form = new Form();
            if(isset($_POST['submitted'])) {
                if(!empty($_POST['message'])) {
                    $message->insert($_SESSION['id'], $getid, $_POST['message']);
                    $success = "Message bien envoyé !";
                } else {
                    $error = "Vous ne pouvez pas envoyer un message vide !";
                }
            }
            ?>
            <div class="row">
                <div class="col-8">
                    <div class="input-field">
                        <?php
                        $form->textarea("message", "message", "materialize-textarea", "255");
                        $form->label("message", "<span class='fa fa-envelope'></span> Écrire votre message ici ...");
                        ?>
                    </div>
                    <div class="col-4">
                        <div class="input-field">
                            <?php
                            $form->btn("submit", "submitted", "Envoyer", "btn right");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $form->get_error(isset($error)? $error : NULL);
            $form->get_success(isset($success)? $success : NULL);
            ?>
        </form>
        <table class="table">
            <tbody>
            <tr>
                <?php
                if(!empty($message->findAllVisible($_SESSION['id'], $getid))) {
                    foreach ($message->findAllVisible($_SESSION['id'], $getid) as $donnees): ?>
                    <td class="row">
                        <span class="font-weight-bold"><?php if($donnees['sender_id'] == $_SESSION['id']) { echo 'Moi: '; } else { echo '@'.$donnees['username'].':'; } ?> </span>
                        <span class="opacity-4 pl-2"><?= $donnees['content']; ?></span>
                        <span class="pl-3 opacity-1 small"><?= $donnees['send_date']; ?></span>
                    </td>
                        <?php
                        endforeach;
                } else { ?>
                    <td class="row">Vous n'avez pas encore envoyé de message ...</td>
                 <?php
                }
                ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
        require_once 'include/footer.php';
    } else {
        header("Location: 404.php");
    }
} else {
    header("Location: ../index.php");
}