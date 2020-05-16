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
                <a class="btn small" href="#"><span class="fa fa-pen"></span></a>
                <a class="btn small red darken-2" href="index.php?page=space&&controller=index&&action=delete&&id=<?= $datas['id'] ?>"><span class="fa fa-trash"></span></a>
            </td>
        </tr>

        <?php
            }
        }
        ?>
        </tbody>
    </table>

</div>