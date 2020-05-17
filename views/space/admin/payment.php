<div class="col-12">
    <h1 class="title">Paiement</h1>
    <a class="btn mb-2" href="index.php?page=space&&controller=payment&&show_payment=true">Effectuer un paiement</a>
    <?php
    $user = new \Model\User();
    $userHasSchool = new \Model\UserHasSchool();
    $payment = new \Model\Payment();
    $show_payment = false;
    if(isset($_GET['show_payment']) AND $_GET['show_payment'] == 'true') {
        $show_payment = true;
    }
    if($show_payment) { ?>
        <div class="payment row m-4">
            <?php
            if(isset($_POST['submitted_payment'])) {
                if(!empty($_POST['student']) AND !empty($_POST['amount'])) {
                    $user_has_school = $userHasSchool->findAll("WHERE users_id = ". $_POST['student']);
                    $user_has_school_user_id = $user_has_school[0]['users_id'];
                    $user_has_school_faculty_id = $user_has_school[0]['faculty_id'];
                    $payment->insert($_POST['student'], $user_has_school_faculty_id, $_POST['amount']);
                }
            }
            ?>
            <form method="POST">
                <div class="input-field col s5 m5">
                    <select class="icons" name="student">
                        <option value="" disabled selected>Selectionner l'étudiant</option>
                        <?php
                        foreach ($user->findAll("WHERE user_category_id = 3", false) as $datas) { ?>
                            <option value="<?= $datas['id'] ?>" data-icon="<?= $datas['profile'] ?>"><?= $datas['last_name']. ' ' .$datas['first_name']. ' - '. $datas['username'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label>Selectionner l'étudiant</label>
                </div>
                <div class="input-field col s5 m5">
                    <?php
                    $form->input("number", "amount", "amount", "validate");
                    $form->label("amount", "Montant du paiement");
                    ?>
                </div>
                <div class="input-field col s2 m2">
                    <?php
                    $form->btn("submit", "submitted_payment", "Effectuer", "btn");
                    ?>
                </div>
            </form>
        </div>
    <?php
    }
    ?>

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
        foreach ($userHasSchool->findAll(NULL, true) as $datas) {

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
        ?>
        </tbody>
    </table>
</div>