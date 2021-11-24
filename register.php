<?php
    session_start();
    require_once("./controller/connection.php");

    $stmt = $conn -> prepare("SELECT * FROM users");
    $stmt -> execute();
    $users = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['register'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $date = $_POST['date'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $cpass = $_POST['cpass'];

            $timestamp = strtotime($date);
            $timestampNow = strtotime('-18 years');

            if(strlen($pass) >= 8) {
                if($pass == $cpass) {
                    if($timestamp > $timestampNow) {
                        echo "<script>alert('Umur harus lebih dari sama dengan 18 tahun!');</script>";
                        echo "<script>window.location = './register.php'</script>";
                    } else {
                        $ada = false;

                        foreach($users as $key => $value) {
                            // Prevent user from entering email address as username
                            if($value['username'] == $username || $value['email'] == $username || $value['email'] == $email) {
                                $ada = true;
                            }
                        }

                        if(!$ada) {
                            $name = $first_name . " " . $last_name;
                            $roles = "Customer";
                            $encrypt = md5($pass);

                            $stmt = $conn -> prepare("INSERT INTO users(username, email, nama, tanggal_lahir, password, roles, first_name, last_name) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt -> bind_param("ssssssss", $username, $email, $name, $date, $encrypt, $roles, $first_name, $last_name);
                            $result = $stmt -> execute();

                            echo "<script>alert('Registration success!');</script>";
                            echo "<script>window.location = './login.php'</script>";
                        } else {
                            echo "<script>alert('Username is already registered!');</script>";
                            echo "<script>window.location = './register.php'</script>";
                        }
                    }
                } else {
                    echo "<script>alert('Password doesn't match!');</script>";
                    echo "<script>window.location = './register.php'</script>";
                }
            } else {
                echo "<script>alert('Password length must be 8 characters or more!');</script>";
                echo "<script>window.location = './register.php'</script>";
            }
        }

        if(isset($_POST['login'])) {
            echo "<script>window.location = './login.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Sign Up | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
    </head>
    <body class="main-layout flex flex-column flex-between">
        <div class="header-section segment">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="login-container container h-auto">
            <div class="landing-padding about flex-center flex-vstart flex-wrap h-auto">
                <div class="modal-login left col-lg-6 col-12">
                    <h1 class="title left">SIGN UP</h1>
                    <form action="" method="POST">
                        <div class="form-group flex flex-between">
                            <div style="width: 47.5%">
                                <input type="text" class="login-input form-info border-radius-small" placeholder="First Name" name="first_name" id="name" required>
                            </div>
                            <div style="width: 47.5%;">
                                <input type="text" class="login-input form-info border-radius-small" placeholder="Last Name" name="last_name" id="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="login-input form-info border-radius-small" name="date" id="date" required placeholder="Date of Birth" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="login-input form-info border-radius-small" placeholder="Username" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="login-input form-info border-radius-small" placeholder="Email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="login-input form-info border-radius-small" placeholder="Password" name="pass" id="pass" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="login-input form-info border-radius-small" placeholder="Confirm Password" name="cpass" id="cpass" required>
                        </div>
                        <button class="login-btn form-info btn btn-dark" name="register">Sign Up</button>
                    </form>
                </div>
                <div class="modal-login right col-lg-6 col-12">
                    <h1 class="title">SIGN IN</h1>
                    <div class="form-info">
                        <div style="padding-bottom: 10px; text-align: justify;">
                            Already have an account? Sign in to experience more benefits from us:
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
                                <button class="login-btn form-info btn btn-dark" name="login">Sign In</button>
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
