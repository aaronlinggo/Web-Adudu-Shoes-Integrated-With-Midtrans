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
        <!-- <script src="./js/jquery-3.6.0.min.js"></script> -->
    </head>
    <body class="main-layout flex flex-column flex-between">
        <div class="header_section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="container h-auto">
            <div class="h-100" style="border: 1px solid rgb(219, 222, 226); border-radius: 8px;">
                <div class="w-100 flex" style="border-bottom: 1px solid rgb(219, 222, 226);">
                    <div id="seeProfile" style="padding: 0 10px;">Your Profile</div>
                    <div id="seeHistory" style="padding: 0 10px;">Transaction History</div>
                </div>
                <div id="inner-container" class="w-100 h-75"></div>
            </div>
        </div>

        <div class="container-fluid" id="history_list">
        </div>
        <?php require_once("./section/footer_section.php") ?>
        <?php //require_once("./section/script_section.php") ?>
        <script>
            $(document).ready(function() {
                $.ajax({
                    "cache": false
                });

                $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
                    options.async = true;
                });

                function loadSection(url, data) {
                    $("#inner-container").html("");

                    $.ajax({
                        method: "GET",
                        url: url,
                        data: {
                            origin: "profile",
                            data: data
                        },
                        success: function(response) {
                            $("#inner-container").html(response);
                        }
                    });
                }

                $("#seeProfile").click(function(e) { 
                    e.preventDefault();
                    loadSection("./section/get_profile.php", <?= json_encode($activeUser) ?>);
                });

                $("#seeHistory").click(function(e) { 
                    e.preventDefault();
                    loadSection("./midtrans/index.php/transaction", "");
                });

                loadSection("./section/get_profile.php", <?= json_encode($activeUser) ?>);
            });
        </script>
    </body>
</html>
