<div class="col-12 col-lg-8">
    <h1 class="title mt-n3 font-weight-bold">Salon de chat</h1>
    <div class="col-12">
        <div class="row">
            <div class="col-lg-8 fixed-bottom col-12">
                <form method="POST">
                    <?php
                    $form = new \App\Form();
                    ?>
                    <div class="input-field">
                        <?php
                        $form->textarea("message", "message", "materialize-textarea", "255");
                        $form->label("message", "<span class='fa fa-envelope'></span> Écrivez votre message ici ...");
                        ?>
                    </div>
                    <div class="input-field">
                        <?php $form->btn("submit", "submitted", "Envoyer", '"btn left"'); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>