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
            </div>
        </div>
    </div>
<?php
} else {
    header("Location: ../index.php");
}