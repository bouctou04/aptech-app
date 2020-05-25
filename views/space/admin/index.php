<?php
$user = new \Model\User();
if(isset($_GET['action']) AND $_GET['action'] == 'delete' && isset($_GET['id']) AND !empty($_GET['id'])) {
    $user->delete($_GET['id']);
}
?>
<div class="col-12 mt-3" id="utilisateurs">
    <a class="btn mb-2" href="index.php?page=space&&controller=register">Ajouter un utilisateur</a>
    <table class="centered responsive-table striped">
        <thead class="teal white-text">
        <tr>
            <th>Nom & Prénom</th>
            <th>Identifiant</th>
            <th>Adresse email</th>
            <th>Sexe</th>
            <th>Catégorie</th>
            <th>Date de Naissance</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($user->findAll())) {
            foreach ($user->findAll("INNER JOIN user_category ON user_category.id = users.user_category_id ORDER BY users.user_category_id ASC") as $datas) {
        ?>

        <tr>
            <td><?= $datas['last_name']. ' ' .$datas['first_name'] ?></td>
            <td><?= $datas['username'] ?></td>
            <td><?= $datas['email'] ?></td>
            <td><?= $datas['sexe'] ?></td>
            <td><?= $datas['field'] ?></td>
            <td><?= $datas['birth_date'] ?></td>
            <td>
                <a class="btn small modal-trigger" href="#editUser<?= $datas['id'] ?>"><span class="fa fa-pen"></span></a>
                <a class="btn small red darken-2" href="index.php?page=space&&controller=index&&action=delete&&id=<?= $datas['id'] ?>"><span class="fa fa-trash"></span></a>
            </td>
            <div id="editUser<?= $datas['id'] ?>" class="modal">
                <?php
                if(isset($_POST['submitted_edit_user'])) {
                    var_dump($_POST);
                    if (!empty($_POST['first_name']) AND !empty($_POST['last_name']) AND !empty($_POST['mail']) AND !empty($_POST['birth_date'])) {
                        if($datas['email'] != $_POST['mail']) {
                            if($user->verifyEmail($_POST['mail']) == false) {
                                $user->update($datas['id'], $_POST['last_name'], $_POST['first_name'], $_POST['mail'], $_POST['birth_date']);
                            } else {
                                $error = "Ce mail est déjà utilié par un autre compte !";
                                redirectTo("index.php?page=space&&controller=index");
                            }
                        } else {
                            $user->update($datas['id'], $_POST['last_name'], $_POST['first_name'], $_POST['mail'], $_POST['birth_date']);
                            redirectTo("index.php?page=space&&controller=index");
                        }
                        echo "Data email == > ". $datas['email']. "<br> POST EMAIL ==> ". $_POST['mail'];
                    } else {
                        $error = "Veuillez renseigné tous les champs !";
                    }
                }

                if(isset($error)) {
                    echo $error;
                }
                ?>
                <form method="POST">
                    <div class="modal-content">
                        <h4>Modifier les infos de <?= $datas['first_name']. ' ' .$datas['last_name'] ?></h4>
                        <div class="input-field">
                            <?php
                            $form->input("text", "first_name", "first_name", "validate", "255", NULL, $datas['first_name']);
                            $form->label("first_name", "Modifier le prénom");
                            ?>
                        </div>
                        <div class="input-field">
                            <?php
                            $form->input("text", "last_name", "last_name", "validate", "255", NULL, $datas['last_name']);
                            $form->label("last_name", "Modifier le prénom");
                            ?>
                        </div>
                        <div class="input-field">
                            <?php
                            $form->input("email", "mail", "mail", "validate", NULL, NULL, $datas['email']);
                            $form->label("mail", "Adresse email");
                            ?>
                        </div>
                        <div class="input-field">
                            <?php
                            $form->input("date", "birth_date", "birth_date", "validate", NULL, NULL, $datas['birth_date']);
                            $form->label("birth_date", "Date de naissance");
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="input-field">
                            <button type="submit" class="btn indigo lighten-5 black-text" data-dismiss="editUser">Annuler</button>
                            <?php
                            $form->btn("submit", "submitted_edit_user", "Enregistrer","btn");
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </tr>

        <?php
            }
        }
        ?>
        </tbody>
    </table>

</div>