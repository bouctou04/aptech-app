<div class="col-12">
    <h1 class="title mt-n3 font-weight-bold">Message</h1>
    <?php
    if(!empty($_GET['id']) AND $_GET['id'] > 0) {
        if(!empty($_GET['sender_id'])  AND $_GET['sender_id'] > 0) {
            $sender_id = intval($_GET['sender_id']);
            $getid = intval($_GET['id']);
            $message = new \Model\Message();
            $user = new \Model\User();
            if(!empty($user->find($sender_id))) { ?>
                <div class="container">
                    <form method="POST">
                        <?php
                        $form = new \App\Form();
                        if(isset($_POST['submitted'])) {
                            if(!empty($_POST['message'])) {
                                if(strlen($_POST['message']) <= 255) {
                                    $message->insert($_SESSION['id'], $sender_id, $_POST['message']);
                                    $success = "Message bien envoyé !";
                                } else {
                                    $error = "Votre message ne doit pas dépasser 255 caractères !";
                                }
                            } else {
                                $error = "Vous ne pouvez pas envoyer un message vide !";
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col-12">
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
                        //$form->get_success(isset($success)? $success : NULL);
                        ?>
                    </form>
                    <div id="loadMessage">
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
                    </div>
                </div>
                <?php
                $message->setRead($getid);
            } else {
                redirectTo("index.php?page=error");
            }
        } else {
            redirectTo("index.php?page=error");
        }
    } else {
        redirectTo("index.php?page=error");
    }
    ?>
</div>