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
        <link rel="stylesheet" href="./css/profile.css">
    </head>
    <body class="main-layout flex flex-column flex-between" style="position: relative;">
        <div class="header-section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <!-- <div class="position-sticky p-3" style="display: none; top: 0; right: 0; z-index: 99999;">
            <div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong style="margin-right: auto;">Well Done!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Your item has been added to cart.
                </div>
            </div>
        </div> -->
        <div class="container h-auto position-relative landing-padding about" style="min-height: 100%;">
            <div class="h-100 py-3">
                <div class="h-100 flex" style="border: 1px solid rgb(219, 222, 226); border-radius: 8px; padding: 20px; overflow-y: hidden;">
                    <div class="col-lg-4 h-auto flex-center flex-vstart" style="padding: 0; position: relative;">
                        <div id="inner1" class="w-100 h-auto" style="padding: 10px; border-radius: 8px; box-shadow: 0 1px 6px 0 rgba(49, 53, 59, 0.12); position: sticky; top: 0;"></div>
                    </div>
                    <div id="inner2" class="h-100 flex col-lg-8" style="max-height: 100%; overflow-y: auto;">
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
