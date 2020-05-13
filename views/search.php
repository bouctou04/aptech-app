<div class="col-12">
    <h1 class="title">Resultat de la recherche</h1>
    <?php
    if(!empty($_GET['ss'])) {
        $search = new \Model\User();
        //var_dump($search->search($_GET['ss']));
        if(!empty($search->search($_GET['ss']))) { ?>
            <table>
                <tbody>
            <?php
            foreach ($search->search($_GET['ss']) as $datas): ?>
                    <tr>
                        <td><span class="font-weight-bold"><a href="">@<?= $datas['username'] ?></a></span> <span class="text-muted">[<?= $datas['first_name'] . ' ' . $datas['last_name'] ?>]</span></td>
                        <td><?= $datas['field'] ?></td>
                        <td><?= $datas['acronym'] ?></td>
                        <td><a href="#!"><span class="fa fa-eye"></span> Voir le profil</a></td>
                        <td><a href="#!"><span class="fa fa-envelope"></span> Envoyer un message</a></td>
                    </tr>
            <?php
            endforeach; ?>
                </tbody>
            </table>
            <?php
        } else { ?>
            Pas de resultat trouvé !
        <?php
        }
    } else {
        redirectTo("index.php?page=error");
    }
    ?>
</div>