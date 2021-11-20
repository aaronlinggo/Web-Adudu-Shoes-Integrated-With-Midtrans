<?php
    session_start();
    require_once("./controller/connection.php");

    if(!isset($_SESSION['active'])) {
        echo "<script>window.location = './login.php';</script>";
    } else {
        $stmt = $conn -> prepare("SELECT * FROM users");
        $stmt -> execute();
        $users = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        }

        $stmt = $conn -> prepare("SELECT * FROM users WHERE id_user = ?");
        $stmt -> bind_param("i", $_SESSION['active']);
        $stmt -> execute();
        $activeUser = $stmt -> get_result() -> fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Profile | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
        <?php require_once("./section/script_section.php") ?>
    </head>
    <body class="main-layout flex flex-column flex-between">
        <div class="header-section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <!-- DESKTOP -->
        <div class="container h-100 py-3">
        <!-- <div class="container h-auto"> -->
            <div class="h-100" style="padding: 0 16px;">
                <div class="h-100 flex" style="border: 1px solid rgb(219, 222, 226); border-radius: 8px; padding: 20px;">
                    <!-- <div class="w-100 flex" style="border-bottom: 1px solid rgb(219, 222, 226);">
                        <div id="seeProfile" style="padding: 0 10px;">Your Profile</div>
                        <div id="seeHistory" style="padding: 0 10px;">Transaction History</div>
                    </div> -->
                    <div class="h-100 flex-center" style="width: 35%; margin-right: 30px;">
                        <div id="inner1" class="w-100 h-100" style="padding: 10px; border-radius: 8px; box-shadow: 0 1px 6px 0 rgba(49, 53, 59, 0.12);">
                        </div>
                    </div>
                    <div id="inner2" class="h-100 flex" style="width: calc(65% - 30px); overflow-y: auto;">
                    </div>
                    <!-- <div class="w-100 h-100" style="padding: 10px; border-radius: 8px; box-shadow: 0 1px 6px 0 rgba(49, 53, 59, 0.12);">
                    </div> -->
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
                // loadSection("./midtrans/index.php/transaction", "");
            });
        </script>
    </body>
</html>
