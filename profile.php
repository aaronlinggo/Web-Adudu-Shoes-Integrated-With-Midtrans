<?php
    session_start();
    require_once("./controller/connection.php");

    $stmt = $conn -> prepare("SELECT * FROM users");
    $stmt -> execute();
    $users = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Profile | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
    </head>
    <body class="main-layout flex flex-column flex-between">
        <div class="header_section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="container-fluid" id="history_list">
            <!-- <div class="container flex-center flex-vstart flex-wrap h-auto">
                <div class="col-lg-6 col-12 h-100" style="padding: 30px;">
                    <h1>Sign In</h1>
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="email-bt" placeholder="Username" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="email-bt" placeholder="Password" name="password" id="password" required>
                        </div>
                        <button class="main_bt" name="login">Sign In</button>
                    </form>
                </div>
                <div class="col-lg-6 col-12 h-100" style="padding: 30px;">
                    <h1>Sign Up</h1>
                    <div>
                        <div style="padding: 10px 0;">
                            It's very easy. Just fill a simple registration form on the next page and you can enjoy more benefits from us:
                        </div>
                        <div class="flex">
                            <ul>
                                <li style="list-style-type: circle;">View your personal information</li>
                                <li style="list-style-type: circle;">Track and check your order</li>
                                <li style="list-style-type: circle;">Proceed with the checkout easily and faster too</li>
                                <form action="" method="POST">
                                    <button class="main_bt" name="register">Sign Up</button>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <?php require_once("./section/footer_section.php") ?>
        <?php require_once("./section/script_section.php") ?>
        <script>
            $(document).ready(function() {
                $.ajax({
                    "cache": false
                });

                $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
                    options.async = true;
                });

                function loadHistory() {
                    $.ajax({
                        method: "GET",
                        url: "./midtrans/index.php/transaction",
                        success: function(response) {
                            $("#history_list").html(response);
                        }
                    });
                }

                loadHistory();
            });
        </script>
    </body>
</html>
