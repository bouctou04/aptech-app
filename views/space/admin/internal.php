<?php
$faculty = new \Model\Faculty();
$level = new \Model\Level();
$period = new \Model\Period();
if($_GET['controller'] == 'internal' && isset($_GET['action']) AND $_GET['action'] == 'delete_faculty' && isset($_GET['id']) AND !empty($_GET['id'])) {
    $faculty->delete($_GET['id']);
    redirectTo("index.php?page=space&&controller=internal");
}
if($_GET['controller'] == 'internal' && isset($_GET['action']) AND $_GET['action'] == 'delete_level' && isset($_GET['id']) AND !empty($_GET['id'])) {
    $level->delete($_GET['id']);
    redirectTo("index.php?page=space&&controller=internal");
}
if($_GET['controller'] == 'internal' && isset($_GET['action']) AND $_GET['action'] == 'delete_period' && isset($_GET['id']) AND !empty($_GET['id'])) {
    $period->delete($_GET['id']);
    redirectTo("index.php?page=space&&controller=internal");
}
?>
    <div class="col-4">
        <h1 class="title">Ajouter une filière</h1>
        <?php
        if(isset($_POST['submitted'])) {
            if(!empty($_POST['faculty'])) {
                $faculty->insert($_SESSION['school_id'], $_POST['faculty']);
            } else {
                $error = "Veuillez renseigné le libellé de la filière ...";
            }
        }
        ?>
        <form method="POST">
            <div class="input-field">
                <?php
                $form->input("text", "faculty", "faculty", "validate", "255");
                $form->label("faculty", "Libellé de la filière");
                ?>
            </div>
            <div class="input-field">
                <?php
                $form->btn("submit", "submitted", "Enregistrer", "btn");
                ?>
            </div>
        </form>
    </div>
    <div class="col-8">
        <h1 class="title">Liste des filières</h1>
        <table class="centered responsive-table striped">
            <thead class="teal white-text">
            <tr>
                <th>Libellé</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($faculty->findAll())) {
                foreach ($faculty->findAll("WHERE school_id = $_SESSION[school_id]") as $datas) {
                    ?>

                    <tr>
                        <td><?= $datas['faculty'] ?></td>
                        <td>
                            <a class="btn small" href="#"><span class="fa fa-pen"></span></a>
                            <a class="btn small red darken-2" href="index.php?page=space&&controller=internal&&action=delete_faculty&&id=<?= $datas['id'] ?>"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>

                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
<hr>
<div class="col-4">
        <h1 class="title">Ajouter un niveau d'étude</h1>
        <?php
        if(isset($_POST['submitted_level'])) {
            if(!empty($_POST['level'])) {
                $level->insert($_SESSION['school_id'], $_POST['level']);
            } else {
                $error = "Veuillez renseigné le libellé du niveau d'étude ...";
            }
        }
        ?>
        <form method="POST">
            <div class="input-field">
                <?php
                $form->input("text", "level", "level", "validate", "255");
                $form->label("level", "Libellé du niveau d'étude");
                ?>
            </div>
            <div class="input-field">
                <?php
                $form->btn("submit", "submitted_level", "Enregistrer", "btn");
                ?>
            </div>
        </form>
    </div>
    <div class="col-8">
        <h1 class="title">Liste des niveaux</h1>
        <table class="centered responsive-table striped">
            <thead class="teal white-text">
            <tr>
                <th>Libellé</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($level->findAll())) {
                foreach ($level->findAll("WHERE school_id = $_SESSION[school_id]") as $datas) {
                    ?>

                    <tr>
                        <td><?= $datas['level'] ?></td>
                        <td>
                            <a class="btn small" href="#"><span class="fa fa-pen"></span></a>
                            <a class="btn small red darken-2" href="index.php?page=space&&controller=internal&&action=delete_level&&id=<?= $datas['id'] ?>"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>

                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
<div class="col-4">
        <h1 class="title">Ajouter une période</h1>
        <?php
        if(isset($_POST['submitted_period'])) {
            if(!empty($_POST['period'])) {
                $period->insert($_SESSION['school_id'], $_POST['period']);
            } else {
                $error = "Veuillez renseigné le libellé la période ...";
            }
        }
        ?>
        <form method="POST">
            <div class="input-field">
                <?php
                $form->input("text", "period", "period", "validate", "255");
                $form->label("period", "Libellé de la période");
                ?>
            </div>
            <div class="input-field">
                <?php
                $form->btn("submit", "submitted_period", "Enregistrer", "btn");
                ?>
            </div>
        </form>
    </div>
    <div class="col-8">
        <h1 class="title">Liste des périodes</h1>
        <table class="centered responsive-table striped">
            <thead class="teal white-text">
            <tr>
                <th>Libellé</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($period->findAll())) {
                foreach ($period->findAll("WHERE school_id = $_SESSION[school_id]") as $datas) {
                    ?>

                    <tr>
                        <td><?= $datas['period'] ?></td>
                        <td>
                            <a class="btn small" href="#"><span class="fa fa-pen"></span></a>
                            <a class="btn small red darken-2" href="index.php?page=space&&controller=internal&&action=delete_period&&id=<?= $datas['id'] ?>"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>

                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
