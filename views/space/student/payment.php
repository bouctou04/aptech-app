<div class="col-12">
    <h1 class="title">Paiement</h1>
    <table class="striped responsive-table centered">
        <thead class="teal white-text">
        <tr>
            <th>Nom & Prénom</th>
            <th>Adresse email</th>
            <th>Filière & Niveau</th>
            <th>Date de paiement</th>
            <th>Montant total à payer</th>
            <th>Montant payé</th>
            <th>Montant total payé</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $montant_paye = 0;
        $montant_restant = 0;
        $userHasSchool = new \Model\UserHasSchool();
        $payment = new \Model\Payment();
        foreach ($userHasSchool->findAll(NULL, true) as $datas) {
                if($datas['users_id'] == $_SESSION['id']) {
                    $montant_paye += $datas['amount_payment'];
            ?>

                    <tr>
                        <td><?= $datas['last_name']. ' '. $datas['first_name'] ?></td>
                        <td><?= $datas['email'] ?></td>
                        <td><?= $datas['faculty']. ' '. $datas['level'] ?></td>
                        <td><?= $datas['payment_date'] ?></td>
                        <td><?= $datas['amount_faculty'] ?></td>
                        <td><?= $datas['amount_payment'] ?></td>
                        <td><?= $montant_paye ?></td>
                    </tr>
            <?php
                }
        }
        ?>
        </tbody>
    </table>
</div>