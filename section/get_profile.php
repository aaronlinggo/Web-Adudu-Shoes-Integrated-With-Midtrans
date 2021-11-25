<?php
    if(!isset($_REQUEST['origin'])) {
        echo "<script>window.location = '../login.php';</script>";
    }
?>

<div>
    <div class="text-center about_text bg-light card" style="background-color: #c4c4c7!important;">
        User ID: <?= $_REQUEST['data']['id_user'] ?>
    </div>
    <div>
        <div class="about_text font-weight-bold">Full Name</div>
        <?= $_REQUEST['data']['nama'] ?>
    </div>
    <div>
        <div class="about_text font-weight-bold">First Name</div>
        <?= $_REQUEST['data']['first_name'] ?>
        <div class="about_text font-weight-bold">Last Name</div>
        <?= $_REQUEST['data']['last_name'] ?>
    </div>
    <div>
        <div class="about_text font-weight-bold">Username</div>
        <?= $_REQUEST['data']['username'] ?>
    </div>
    <div>
        <div class="about_text font-weight-bold">Email</div>
        <?= $_REQUEST['data']['email'] ?>
    </div>
    <div>
        <div class="about_text font-weight-bold">Date of Birth</div>
        <?= $_REQUEST['data']['tanggal_lahir'] ?>
    </div>
</div>
