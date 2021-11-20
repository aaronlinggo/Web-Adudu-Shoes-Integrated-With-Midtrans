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
        <div class="header-section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="container-fluid">
            <div class="container flex-center flex-vstart flex-wrap h-auto">
                <div class="modal-login left col-lg-6 col-12 h-100">
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
                <div class="modal-login right col-lg-6 col-12 h-100">
                    <h1>Sign Up</h1>
                    <div>
                        <div style="padding: 10px 0; text-align: justify;">
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
            </div>
        </div>
        <?php require_once("./section/footer_section.php") ?>
        <?php require_once("./section/script_section.php") ?>
    </body>
</html>