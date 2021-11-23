<?php
    if(!isset($_REQUEST['origin'])) {
        echo "<script>window.location = '../login.php';</script>";
    }
?>

<div>
    <div class="text-center lorem_text bg-light card" style="background-color: #c4c4c7 !important;">User ID: <?= $_REQUEST['data']['id_user'] ?></div>
    <div>
        <div class="lorem_text font-weight-bold">Nama</div>
        <?= $_REQUEST['data']['nama'] ?>
    </div>
    <div>
        <div class="lorem_text font-weight-bold">Username</div>
        <?= $_REQUEST['data']['username'] ?>
    </div>
    <div>
        <div class="lorem_text font-weight-bold">Email</div>
        <?= $_REQUEST['data']['email'] ?>
    </div>
    <div>
        <div class="lorem_text font-weight-bold">Tanggal Lahir</div>
        <?= $_REQUEST['data']['tanggal_lahir'] ?>
    </div>
</div>
