<?php
    if(!isset($_REQUEST['origin'])) {
        echo "<script>window.location = '../login.php';</script>";
    }
?>

<div>
    <div>Nama: <?= $_REQUEST['data']['nama'] ?></div>
    <div>Username: <?= $_REQUEST['data']['username'] ?></div>
    <div>Email: <?= $_REQUEST['data']['email'] ?></div>
    <div>Tanggal Lahir: <?= $_REQUEST['data']['tanggal_lahir'] ?></div>

    <!-- <div><?= var_dump($_REQUEST['origin']) ?></div> -->
    <!-- <div><?= var_dump(isset(($_REQUEST['id_user']))) ?></div>
    <div><?= $_REQUEST['data']['username'] ?></div> -->
    <!-- <div>SAFE</div> -->
    <!-- <div><?= json_encode($activeUser['id_user']) ?></div>
    <div><?= $activeUser['first_name'] ?></div>
    <div><?= $activeUser['last_name'] ?></div>
    <div><?= $activeUser['username'] ?></div> -->
    <!-- <div><?= $activeUser['email'] ?></div>
    <div><?= $activeUser['nama'] ?></div>
    <div><?= $activeUser['tanggal_lahir'] ?></div> -->
</div>
