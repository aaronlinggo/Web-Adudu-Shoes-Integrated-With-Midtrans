<?php
    session_start();
    require_once("./controller/connection.php");

    $stmt = $conn -> prepare("SELECT * FROM users");
    $stmt -> execute();
    $users = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

    if(isset($_SESSION['activeRoles'])) {
        if($_SESSION['activeRoles'] == "admin") {
            header("Location: ./admin/index.php");
        } else if($_SESSION['activeRoles'] == "Customer") {
            header("Location: ./");
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $ada = false;

            foreach($users as $key => $value) {
                if($username == $value['username']) {
                    if(md5($password) == $value['password']) {
                        if($value['roles'] == "admin") {
                            $_SESSION['active'] = $value['id_user'];
                            $_SESSION['activeRoles'] = "admin";
                            header("Location: ./admin/index.php");
                        } else {
                            echo "<script>alert('Error Code 403: Forbidden!')</script>";
                            echo "<script>window.location = './'</script>";
                        }
                    } else {
                        echo "<script>alert('You entered wrong password!')</script>";
                            echo "<script>window.location = './cpanel.php'</script>";
                    }

                    $ada = true;
                }
            }

            if(!$ada) {
                echo "<script>alert('Username is not found!')</script>";
                echo "<script>window.location = './'</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>cPanel | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
    </head>
    <body id="cpanel" class="main-layout flex-center flex-between">
        <div class="container-fluid">
            <div class="container flex-center flex-hstart flex-column flex-wrap h-auto">
                <div class="w-100 flex-center cpanel-logo-container">
                    <img class="cpanel-logo" src="./images/cpanel-logo-2.svg" alt="">
                </div>
                <div class="modal-login left col-lg-6 col-12" style="padding: 0;">
                    <h1 class="title left">SIGN IN</h1>
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="login-input form-info border-radius-small" placeholder="Username" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="login-input form-info border-radius-small" placeholder="Password" name="password" id="password" required>
                        </div>
                        <button class="login-btn form-info btn btn-dark" name="login">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once("./section/script_section.php") ?>
    </body>
</html>
