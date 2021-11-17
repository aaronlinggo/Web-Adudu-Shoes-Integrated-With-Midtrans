<?php
session_start();
require_once("./controller/connection.php");

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

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
                        if($value['username'] == $username || $value['email'] == $email) {
                            $ada = true;
                        }
                    }

                    if(!$ada) {
                        $name = $first_name . " " . $last_name;
                        $roles = "Customer";
                        $encrypt = md5($pass);

                        $stmt = $conn->prepare("INSERT INTO users(username, email, nama, tanggal_lahir, password, roles, first_name, last_name) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssssssss", $username, $email, $name, $date, $encrypt, $roles, $first_name, $last_name);
                        $result = $stmt->execute();

                        // echo "<script>alert('Registration success!');</script>";
                        // echo "<script>window.location = './login.php'</script>";
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
        <div class="header_section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="container-fluid">
            <div class="container flex-center flex-vstart flex-wrap h-auto">
                <div class="col-lg-6 col-12 h-100" style="padding: 30px;">
                    <h1>Sign Up</h1>
                    <form action="" method="POST">
                        <div class="form-group flex flex-between">
                            <div style="width: 47.5%">
                                <input type="text" class="email-bt" placeholder="First Name" name="first_name" id="name" required>
                            </div>
                            <div style="width: 47.5%;">
                                <input type="text" class="email-bt" placeholder="Last Name" name="last_name" id="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="date" class="email-bt" name="date" id="date" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="email-bt" placeholder="Username" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="email-bt" placeholder="Email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="email-bt" placeholder="Password" name="pass" id="pass" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="email-bt" placeholder="Confirm Password" name="cpass" id="cpass" required>
                        </div>
                        <button class="main_bt" name="register">Sign Up</button>
                    </form>
                </div>
                <div class="col-lg-6 col-12 h-100" style="padding: 30px;">
                    <h1>Sign In</h1>
                    <div>
                        <div style="padding: 10px 0;">
                            Already have an account? Sign in to experience more benefits from us:
                        </div>
                        <div class="flex">
                            <ul>
                                <li style="list-style-type: circle;">View your personal information</li>
                                <li style="list-style-type: circle;">Track and check your order</li>
                                <li style="list-style-type: circle;">Proceed with the checkout easily and faster too</li>
                                <form action="" method="POST">
                                    <button class="main_bt" name="login">Sign In</button>
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