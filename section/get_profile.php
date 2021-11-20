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
</div>
