<?php
session_start();
require_once("./controller/connection.php");

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $ada = false;

        foreach($users as $key => $value){
            if ($username == $value['username']){
                if (md5($password) == $value['password']){
                    $_SESSION['active'] = $value['id_user'];
                    if ($value['roles'] == "admin"){
                        header("Location: ./admin/index.php");
                    }
                    else{
                        header("Location: ./index.php");
                    }
                }
                else{
                    echo "<script>alert('Wrong Password!')</script>";
                    echo "<script>window.location = './login.php'</script>";
                }
                $ada = true;
            }
        }

        if (!$ada){
            echo "<script>alert('Username not found !')</script>";
            echo "<script>window.location = './login.php'</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Sign In</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php require_once("./section/connection_head.php") ?>
</head>
<body class="main-layout">
    <div class="header_section">
        <?php require_once("./section/nav_section.php") ?>
    </div>
    <div class="collection_text">Sign In</div>
    <div class="layout_padding contact_section">
        <div class="container-fluid ram">
            <div class="row">
                <div class="col-md-12">
                    <div class="loginregisterbox">
                        <div class="input_main">
                            <div class="container">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="username" class="email-bt" style="border: none; color: white;">Username</label>
                                        <input type="text" class="email-bt" placeholder="Username" name="username" id="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="email-bt" style="border: none; color: white;">Password</label>
                                        <input type="password" class="email-bt" placeholder="Password" name="password" id="password" required>
                                    </div>
                                    <div class="send_btn">
                                        <button class="main_bt" name="login">Login</button>
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