<?php
    if(!isset($_REQUEST['origin'])) {
        echo "<script>window.location = '../login.php';</script>";
    }
?>

<div>
    <div class="text-center about_text bg-light card" style="background-color: #c4c4c7!important; box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.2); margin-bottom: 10px; font-weight: 500;">User ID: <?= $_REQUEST['data']['id_user'] ?></div>
    <div class="w-100 flex-center py-2 mb-1" style="font-size: 22px; font-weight: 600; text-decoration: underline;">Your Profile</div>
    <div>
        <div class="about_text font-weight-bold">Full Name</div>
        <div class="profile-info flex-center flex-hstart" style="margin-bottom: 10px;">
            <?= $_REQUEST['data']['nama'] ?>
        </div>
    </div>
    <div>
        <div class="about_text font-weight-bold">
            First Name
        </div>
        <div class="profile-info flex-center flex-hstart" style="margin-bottom: 10px;">
            <?= $_REQUEST['data']['first_name'] ?>
        </div>
        <div class="about_text font-weight-bold">
            Last Name
        </div>
        <div class="profile-info flex-center flex-hstart" style="margin-bottom: 10px;">
            <?= $_REQUEST['data']['last_name'] ?>
        </div>
    </div>
    <div>
        <div class="about_text font-weight-bold">Username</div>
        <div class="profile-info flex-center flex-hstart" style="margin-bottom: 10px;">
            <?= $_REQUEST['data']['username'] ?>
        </div>
    </div>
    <div>
        <div class="about_text font-weight-bold">Email</div>
        <div class="profile-info flex-center flex-hstart" style="margin-bottom: 10px;">
            <?= $_REQUEST['data']['email'] ?>
        </div>
    </div>
    <div>
        <div class="about_text font-weight-bold">Date of Birth</div>
        <div class="profile-info flex-center flex-hstart">
            <?= $_REQUEST['data']['tanggal_lahir'] ?>
        </div>
    </div>
</div>
