<?php
session_start();
require_once("../controller/connection.php");


if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
} else {
    $id_user = $_SESSION['active'];
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id_user=$id_user");
$stmt->execute();
$admin = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <meta http-equiv="X-UA-Compatible" charset="UTF-8" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/logo.png" type="image/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

</head>

<body class="main-layout">
    <div class="row">
        <div class="col-2">
            <div class="header_section" style="min-height: 100vh;">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light flex-column flex-hend flex-between fullheight">
                        <div class="logo">
                            <a href="../index.php" class="flex flex-hstart">
                                <img class="top-logo" src="../images/logo_2.png">
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="sidebar">
                            <div class="navbar-nav flex flex-column flex-between flex-vcenter fullwidth">
                                <div class="medium-scale flex flex-column">
                                    <a class="nav-item nav-link nav-android-menu" href="./index.php">Dashboard</a>
                                    <a class="nav-item nav-link nav-android-menu" href="#">Products</a>
                                    <a class="nav-item nav-link nav-android-menu" href="#">Report</a>
                                </div>
                                <div class="medium-scale flex flex-vcenter flex-column">
                                    <a class="nav-item nav-link profile flex flex-hend" href="#">
                                        <img src="../images/user_24px_black.png">
                                    </a>
                                    <a class="btn btn-outline-danger fullheight" href="../logout.php">Sign Out</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-10">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <meta charset="utf-8">
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-lg-12 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">List Users</h4>
                                                        <div class="table-responsive" id="tableUpdate">
                                                            <table class="table table-hover" style="text-align: center;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID USER</th>
                                                                        <th>Username</th>
                                                                        <th>Email</th>
                                                                        <th>Nama</th>
                                                                        <th>Tanggal Lahir</th>
                                                                        <th>Roles</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($users as $key => $value) { ?>
                                                                        <tr>
                                                                            <td><?= $value['id_user'] ?></td>
                                                                            <td><?= $value['username'] ?></td>
                                                                            <td><?= $value['email'] ?></td>
                                                                            <td><?= $value['nama'] ?></td>
                                                                            <td><?= $value['tanggal_lahir'] ?></td>
                                                                            <td>
                                                                                <?php
                                                                                if ($value['roles'] == "admin") {
                                                                                    echo "<div class='btn btn-danger' style='cursor: default; margin:0;'>admin</div>";
                                                                                } else {
                                                                                    echo "<div class='btn btn-success' style='cursor: default; margin:0;'>Customer<div>";
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>

    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="../js/plugin.js"></script>
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/custom.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>