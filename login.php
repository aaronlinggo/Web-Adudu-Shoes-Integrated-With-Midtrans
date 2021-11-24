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
                        if($value['roles'] == "Customer") {
                            $_SESSION['active'] = $value['id_user'];
                            $_SESSION['activeRoles'] = "Customer";

                            header("Location: ./");
                        } else {
                            echo "<script>alert('Error Code 403: Forbidden!')</script>";
                            echo "<script>window.location = './login.php'</script>";
                        }
                    } else {
                        echo "<script>alert('You entered wrong password!')</script>";
                        echo "<script>window.location = './login.php'</script>";
                    }

                    $ada = true;
                }
            }

            if(!$ada) {
                echo "<script>alert('Username is not found!')</script>";
                echo "<script>window.location = './login.php'</script>";
            }
        }

        if(isset($_POST['register'])) {
            echo "<script>window.location = './register.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Sign In | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
    </head>
    <body class="main-layout flex flex-column flex-between">
        <div class="header-section segment">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="login-container container h-auto">
            <div class="landing-padding about flex-center flex-vstart flex-wrap h-auto">
                <div class="modal-login left col-lg-6 col-12">
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
                <div class="modal-login right col-lg-6 col-12">
                    <h1 class="title">SIGN UP</h1>
                    <div class="form-info">
                        <div style="padding-bottom: 10px; text-align: justify;">
                            It's very easy. Just fill a simple registration form on the next page and you can enjoy more benefits from us:
                        </div>
                        <div class="flex flex-column">
                            <table class="form-group">
                                <tbody>
                                    <tr class="flex flex-vstart">
                                        <td>&check;&nbsp;&nbsp;&nbsp;</td>
                                        <td>View your personal information</td>
                                    </tr>
                                    <tr class="flex flex-vstart">
                                        <td>&check;&nbsp;&nbsp;&nbsp;</td>
                                        <td>Track and check your order</td>
                                    </tr>
                                    <tr class="flex flex-vstart">
                                        <td>&check;&nbsp;&nbsp;&nbsp;</td>
                                        <td>Proceed with the checkout easily and faster too</td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="" method="POST">
                                <button class="login-btn form-info btn btn-dark" name="register">Sign Up</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("./section/footer_section.php") ?>
        <?php require_once("./section/script_section.php") ?>
    </body>
</html>
