<div class="col-12">
    <h1 class="title">Cours</h1>
    <?php
    $course = new \Model\Course();
    ?>
    <table class="striped responsive-table centered">
        <thead class="teal white-text">
        <tr>
            <th>Matière</th>
            <th>Filière & Niveau</th>
            <th>Date d'ajout</th>
            <th>Support de cours</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($course->findAll() as $datas) { ?>
            <tr>
                <td><?= $datas['domain'] ?></td>
                <td><?= $datas['faculty']. ' ' .$datas['level'] ?></td>
                <td><?= $datas['date_add'] ?></td>
                <td><a href="<?= $datas['file'] ?>">Télécharger</a></td>
            </tr>
            <?php
        }
        ?>

        </tbody>
    </table>
</div>