<div class="col-12">
    <h1 class="title">Paiement</h1>
    <table class="striped responsive-table centered">
        <thead class="teal white-text">
        <tr>
            <th>Nom & Prénom</th>
            <th>Adresse email</th>
            <th>Filière & Niveau</th>
            <th>Montant total à payer</th>
            <th>Montant total payé</th>
            <th>Montant total restant à payer</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $montant_paye = 0;
        $montant_restant = 0;
        $userHasSchool = new \Model\UserHasSchool();
        foreach ($userHasSchool->findAll(NULL, true) as $datas) {
                if($datas['users_id'] == $_SESSION['id']) {
            ?>

            <tr>
                <td><?= $datas['last_name']. ' '. $datas['first_name'] ?></td>
                <td>d<?= $datas['email'] ?></td>
                <td><?= $datas['faculty']. ' '. $datas['level'] ?></td>
                <td><?= $datas['amount_faculty'] ?></td>
                <td>200.000</td>
                <td>600.000</td>
            </tr>
            <?php
                }
        }
        ?>
        </tbody>
    </table>
</div>