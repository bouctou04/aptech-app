<div class="col-12">
    <h1 class="title">Cours</h1>
    <div class="row">
        <form method="POST" enctype="multipart/form-data">
            <?php
            $faculty = new \Model\Faculty();
            $course = new \Model\Course();
            if(isset($_POST['submitted'])) {
                if(!empty($_POST['domain']) AND !empty($_POST['faculty']) AND !empty($_FILES['file-input']['name'])) {
                    $name = $_FILES['file-input']['name'];
                    $type = strtolower(substr(strrchr($name, "."), 1));
                    $tmp_name = $_FILES['file-input']['tmp_name'];
                    $file_error = $_FILES['file-input']['error'];
                    $size = $_FILES['file-input']['size'];

                    $max_size = 100097152;
                    $type_accept = array("pdf", "docx", "doc", "ppt", "odt", "xls", "txt");

                    if($size <= $max_size) {
                        if(in_array($type, $type_accept)) {
                            $path = 'public/media/docs/'. $_POST['domain'] . '-' . date('d-m-Y') . '.' . $type;
                            $file_upload = move_uploaded_file($tmp_name, $path);
                            if($file_upload) {
                                $course->insert($_POST['domain'], $_POST['faculty'], $_SESSION['id'], $path);
                            }
                        } else {
                            $erreur = "Votre fichier doit ếtre au format (jpg, jpeg, png, gif)";
                        }
                    } else {
                        $erreur = "Votre fichier ne doit pas dépasser 2Mo";
                    }
                }
            }
            ?>
            <div class="input-field col s3 m3">
                <?php
                $form->input("text", "domain", "domain", "validate");
                $form->label("domain", "Matière");
                ?>
            </div>
            <div class="input-field col s4 m4">
                <select name="faculty">
                    <option value="" disabled selected>Selectionner la filière</option>
                    <?php
                    foreach ($faculty->findAll("WHERE school_id = ". $_SESSION['school_id']) as $datas) { ?>
                        <option value="<?= $datas['id'] ?>"><?= $datas['faculty']. ' '. $datas['level'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label>Materialize Select</label>
            </div>
            <div class="file-field input-field col s4 m4">
                <div class="btn">
                    <span>Fichier</span>
                    <?php $form->input("file", "file-input"); ?>
                </div>
                <div class="file-path-wrapper">
                    <?php $form->input("text", "file", "file", "file-path validate", NULL, '"Importer un fichier)"'); ?>
                </div>
            </div>
            <div class="input-field col s4 m4">
                <?php
                $form->btn("submit", "submitted", "Publier", "btn");
                ?>
            </div>
        </form>
    </div>
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