
<div class="col-12">
    <h1 class="title mt-n3 font-weight-bold">Membres</h1>
    <?php
    $user = new \Model\User();
    if(!empty($user->findAll())) {
        foreach ($user->findAll("INNER JOIN user_category ON user_category.id = users.user_category_id") as $datas):
            if($datas['id'] != $_SESSION['id']) { ?>
                <ul class="collection">
                    <li class="collection-item avatar">
                        <div class="">
                            <img src="<?= $datas['profile'] ?>" alt="" class="circle">
                            <a href="index.php?page=profile&&id=<?= $datas['id'] ?>"><span class="title font-weight-bold">@<?= $datas['username'] ?></span></a>
                            <p class="text-muted d-block">
                                <?= $datas['field'] ?>
                            </p>
                        </div>
                        <a href="index.php?page=read_message&&id=<?= $datas['id'] ?>" class="secondary-content col-2"><span class="fa fa-envelope"></span> Message</a>
                    </li>
                </ul>
                <?php
            }
        endforeach;
    } else {
        echo "Pas de membre !";
    }
    ?>
</div>