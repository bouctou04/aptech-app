<div class="col-12">
    <h1 class="title mt-n3 font-weight-bold">Boîte de réception</h1>
    <div class="col-12">
        <table class="table">
            <tbody>
            <tr id="reception">
                <?php
                $message = new \Model\Message();
                if(!empty($message->getReception($_SESSION['id']))) {
                    foreach ($message->getReception($_SESSION['id']) as $datas): ?>
                            <?php
                            if($_SESSION['id'] != $datas['sender_id']) {
                                if($datas['read'] == 0) { ?>
                                    <td class="row m-auto">
                                        <span class="font-weight-bold"><a href="index.php?page=read_message&&id=<?= $datas['id'] ?>&&sender_id=<?= $datas['sender_id'] ?>">@<?= $datas['username'] ?></a> </span>
                                        <span class="opacity-4 pl-2"><?= $datas['content'] ?></span>
                                        <span class="pl-3 opacity-1 small"><?= time_elapsed_string($datas['send_date']) ?></span>
                                    </td>
                                <?php
                                } elseif ($datas['read'] == 1) { ?>
                                    <td class="row m-auto">
                                        <span class=""><a href="index.php?page=read_message&&id=<?= $datas['id'] ?>&&sender_id=<?= $datas['sender_id'] ?>">@<?= $datas['username'] ?></a> </span>
                                        <span class="opacity-4 pl-2"><?= $datas['content'] ?></span>
                                        <span class="pl-3 opacity-1 small"><?= time_elapsed_string($datas['send_date']) ?></span>
                                    </td>
                                <?php
                                }
                            }
                            ?>
                    <?php
                    endforeach;
                } else { ?>
                    <td class="row">Votre boîte de reception est vide ...</td>
                    <?php
                }
                ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>