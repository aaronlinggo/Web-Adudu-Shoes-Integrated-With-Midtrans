<?php
    session_start();
    require_once("./controller/connection.php");

    if(!isset($_SESSION['active'])) {
        echo "<script>window.location = './login.php';</script>";
    } else {
        $stmt = $conn -> prepare("SELECT * FROM users");
        $stmt -> execute();
        $users = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

        $id_user = $_SESSION['active'];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        }

        $stmt = $conn -> prepare("SELECT * FROM users WHERE id_user = ?");
        $stmt -> bind_param("i", $_SESSION['active']);
        $stmt -> execute();
        $activeUser = $stmt -> get_result() -> fetch_assoc();

        $stmt = $conn->prepare("SELECT * FROM notification_handler WHERE id_user = $id_user and active = 1 ORDER BY ID DESC");
        $stmt->execute();
        $notification_handler = $stmt->get_result()->fetch_assoc() ?? [];
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Profile | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
        <?php require_once("./section/script_section.php") ?>
        <link rel="stylesheet" href="./css/profile.css">
    </head>
    <body class="main-layout flex flex-column flex-between">
		<div id="header" class="header-section segment">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <?php
            if (isset($notification_handler)){
                if (count($notification_handler)>0){
                    ?>
                    <div id="notifPopup" class="position-sticky" style="display: none;">
                        <div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong style="margin-right: auto;">Payment Notification</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">Your #<?= $notification_handler['order_id'] ?> transaction is <?php if ($notification_handler['status'] == 'expire') { echo "not"; } ?> complete.</div>
                        </div>
                    </div>
                    <script>
                        let notifTimer;
                        let calcHeaderHeight = $("#header").height() + 30;
    
                        $(document).ready(function() {
                            $(".btn-close").click(function(e) {
                                e.preventDefault();
                                clearTimeout(notifTimer);
    
                                $("#liveToast").removeClass("show");
                                $("#liveToast").addClass("hide");
    
                                setTimeout(() => {
                                    $("#notifPopup").removeAttr("style");
                                    $("#notifPopup").css({ "display": "none" });
                                }, 250);
                            });
                        });
                        $("#notifPopup").removeAttr("style");
                        $("#notifPopup").css({
                            "display": "block",
                            "top": calcHeaderHeight,
                            "right": "0",
                            "z-index": "99999"
                        });
    
                        clearTimeout(notifTimer);
    
                        setTimeout(() => {
                            $("#liveToast").removeClass("hide");
                            $("#liveToast").addClass("show");
                        }, 250);
    
                        notifTimer = setTimeout(() => {
                            $("#liveToast").removeClass("show");
                            $("#liveToast").addClass("hide");
    
                            setTimeout(() => {
                                $("#notifPopup").removeAttr("style");
                                $("#notifPopup").css({ "display": "none" });
                            }, 250);
                        }, 5000);
                    </script>
                    <?php
                    $id_notif = $notification_handler['id'];
                    $temp_active = 0;
                    $result = $conn -> query("update notification_handler set active = $temp_active where id = $id_notif");
                }
            }
        ?>
        <div class="container landing-padding about h-auto flex-center position-relative">
            <div class="w-100 h-auto py-3">
                <div class="profile-container h-auto flex flex-wrap">
                    <div class="inner1-parent col-lg-4 h-auto flex-center flex-vstart position-relative">
                        <div id="inner1" class="w-100 h-auto"></div>
                    </div>
                    <div id="inner2" class="h-auto flex col-lg-8" style="border-radius: 8px; box-shadow: 0 1px 6px 0 rgba(49, 53, 59, 0); overflow-y: auto; min-height: 150px;">
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("./section/footer_section.php") ?>
        <script>
            $(document).ready(function() {
                $.ajax({
                    "cache": false
                });

                $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
                    options.async = true;
                });

                function loadSection(url, data, obj) {
                    $(obj).html("");
                    $.ajax({
                        method: "GET",
                        url: url,
                        data: {
                            origin: "profile",
                            data: data
                        },
                        success: function(response) {
                            $(obj).html(response);
                        }
                    });
                }

                $("#seeProfile").click(function(e) { 
                    e.preventDefault();
                    loadSection("./section/get_profile.php", <?= json_encode($activeUser) ?>, "#inner1");
                });

                $("#seeHistory").click(function(e) { 
                    e.preventDefault();
                    loadSection("./midtrans/index.php/transaction", "", "#inner2");
                });

                loadSection("./section/get_profile.php", <?= json_encode($activeUser) ?>, "#inner1");
                loadSection("./midtrans/index.php/transaction", "", "#inner2");
            });
        </script>
    </body>
</html>
