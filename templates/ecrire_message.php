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
        if(empty($message->findReceptor($getid))){
            header("Location: 404.php");
        }

        require_once 'include/header.php';
        require_once 'include/aside.php';
        require_once '../libraries/Form.class.php';
         ?>
<div class="col-12 col-lg-9 col-xl-9">
    <h3 class="text-center font-weight-bold">Messages</h3>
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
            <div class="form-group">
                <?php $form->textarea("message", "form-control", "message", "Écrire votre message ici ..."); ?>
            </div>
            <div class="form-group">
                <?php $form->btn("submit", "submitted", "Envoyer le message", '"btn btn-success w-100"'); ?>
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
                        <span class="font-weight-bold"><?php if($donnees['sender_id'] == $_SESSION['id']) { echo 'Moi : '; } else { echo '@'.$donnees['username']; } ?> </span>
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