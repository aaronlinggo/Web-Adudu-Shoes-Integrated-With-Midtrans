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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body class="main-layout">
    <div class="header_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo"><a href="#"><img src="images/logo.png"></a></div>
                </div>
                <div class="col-sm-9">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav" style="align-items: center;">
                                <a class="nav-item nav-link" href="./index.php">Home</a>
                                <a class="nav-item nav-link" href="./collection.php">Collection</a>
                                <a class="nav-item nav-link" href="./shoes.php">Shoes</a>
                                <a class="nav-item nav-link last" href="#">
                                    <img src="./images/search_icon_black.png">
                                </a>
                                <a class="nav-item nav-link last" href="./cart.php">
                                    <img src="./images/shop_icon_black.png">
                                </a>
                                <?php 
                                if (!isset($_SESSION['active'])) { ?>
                                    <a class="btn btn-outline-danger" href="login.php" style="height: 100%;">Sign In</a>
                                    <a class="btn btn-outline-danger" href="register.php" style="height: 100%;">Sign Up</a>
                                <?php }
                                else{ ?>
                                    <a class="nav-item nav-link" href="#">
                                        <img src="./images/user_24px_black.png">
                                    </a>
                                    <a class="btn btn-outline-danger" href="logout.php" style="height: 100%;">Sign Out</a>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
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
    <div class="copyright">2019 All Rights Reserved. <a href="https://html.design">Free html Templates</a></div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });


            $('#myCarousel').carousel({
                interval: false
            });
            $("#myCarousel").on("touchstart", function(event) {

                var yClick = event.originalEvent.touches[0].pageY;
                $(this).one("touchmove", function(event) {

                    var yMove = event.originalEvent.touches[0].pageY;
                    if (Math.floor(yClick - yMove) > 1) {
                        $(".carousel").carousel('next');
                    } else if (Math.floor(yClick - yMove) < -1) {
                        $(".carousel").carousel('prev');
                    }
                });
                $(".carousel").on("touchend", function() {
                    $(this).off("touchmove");
                });
            });
        });
    </script>
</body>

</html>