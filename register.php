<?php
session_start();
require_once("./controller/connection.php");

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])){
        $email = $_POST['email'];
        $username = $_POST['username'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $timestamp = strtotime($date);
        $timestampNow = strtotime('-18 years');
        if ($email != ""){
            if ($username != ""){
                if ($name != ""){
                    if($date != ""){
                        if($pass != ""){
                            if ($cpass != ""){
                                if (strlen($pass) >= 8){
                                    if ($pass == $cpass){
                                        if ($timestamp > $timestampNow){
                                            echo "<script>alert('Umur harus >= 18');</script>";
                                            echo "<script>window.location = './register.php'</script>";
                                        }
                                        else{
                                            $ada = false;

                                            foreach($users as $key => $value){
                                                if ($value['username'] == $username || $value['email'] == $email){
                                                    $ada = true;
                                                }
                                            }
                                            if (!$ada){
                                                $saldo = 0;
                                                $roles = "Customer";
                                                $encrypt = md5($pass);
                                                $stmt = $conn->prepare("INSERT INTO users(username, email, nama, tanggal_lahir, saldo, password, roles) VALUES(?,?,?,?,?,?,?)");
                                                $stmt->bind_param("ssssiss", $username, $email, $name, $date, $saldo, $encrypt, $roles);
                                                $result = $stmt->execute();

                                                echo "<script>alert('Registration Success');</script>";
                                                echo "<script>window.location = './login.php'</script>";
                                            }
                                            else{
                                                echo "<script>alert('Username sudah terdaftar');</script>";
                                                echo "<script>window.location = './register.php'</script>";
                                            }
                                        }
                                    }
                                    else{
                                        echo "<script>alert('Password tidak sama');</script>";
                                        echo "<script>window.location = './register.php'</script>";
                                    }
                                }
                                else{
                                    echo "<script>alert('Password minimmum 8 Character');</script>";
                                    echo "<script>window.location = './register.php'</script>";
                                }
                            }
                            else{
                                echo "<script>alert('Confirm Password Kosong');</script>";
                                echo "<script>window.location = './register.php'</script>";
                            }
                        }
                        else{
                            echo "<script>alert('Password Kosong');</script>";
                            echo "<script>window.location = './register.php'</script>";
                        }
                    }
                    else{
                        echo "<script>alert('Date Kosong');</script>";
                        echo "<script>window.location = './register.php'</script>";
                    }
                }
                else{
                    echo "<script>alert('Full Name Kosong');</script>";
                    echo "<script>window.location = './register.php'</script>";
                }
            }
            else{
                echo "<script>alert('Username Kosong');</script>";
                echo "<script>window.location = './register.php'</script>";
            }
        }
        else{
            echo "<script>alert('Email Kosong');</script>";
            echo "<script>window.location = './register.php'</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Sign Up | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
    </head>
    <body class="main-layout">
        <div class="header_section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="collection_text">Sign Up</div>
        <div class="layout_padding contact_section">
            <div class="container-fluid ram">
                <div class="row">
                    <div class="col-md-12">
                        <div class="loginregisterbox">
                            <div class="input_main">
                                <div class="container">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="email" class="email-bt" style="border: none; color: white;">Email</label>
                                            <input type="email" class="email-bt" placeholder="Email" name="email" id="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="email-bt" style="border: none; color: white;">Username</label>
                                            <input type="text" class="email-bt" placeholder="Username" name="username" id="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="email-bt" style="border: none; color: white;">Full Name</label>
                                            <input type="text" class="email-bt" placeholder="Full Name" name="name" id="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date" class="email-bt" style="border: none; color: white;">Date of Birth</label>
                                            <input type="date" class="email-bt" name="date" id="date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pass" class="email-bt" style="border: none; color: white;">Password</label>
                                            <input type="password" class="email-bt" placeholder="Password" name="pass" id="pass" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cpass" class="email-bt" style="border: none; color: white;">Confirm Password</label>
                                            <input type="password" class="email-bt" placeholder="Confirm Password" name="cpass" id="cpass" required>
                                        </div>
                                        <div class="send_btn">
                                            <button class="main_bt" name="register">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("./section/footer_section.php") ?>
        <?php require_once("./section/script_section.php") ?>
    </body>
</html>