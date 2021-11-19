<?php
session_start();
require_once("../controller/connection.php");


if (!isset($_SESSION['active'])) {
    header('Location: ../index.php');
} else {
    $id_user = $_SESSION['active'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id_user=$id_user");
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();
    if ($admin['roles'] != "admin"){
        header('Location: ../index.php');
    }
}

$stmt = $conn->prepare("SELECT * FROM payment");
$stmt->execute();
$payment = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="main-layout" style="background-color: #f4f5f7;">
    <?php require_once("./section/svg_section.php") ?>
    <div class="row">
        <div class="col-lg-2">
            <div class="header_section" style="min-height: 100vh; background-color: transparent;">
                <div class="container">
                    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                        <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                            <span class="fs-4"><img src="../images/logo.png" alt="" style="width: 8vw;"></span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto" style="width: 200px;">
                            <li>
                                <a href="./index.php" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16">
                                        <use xlink:href="#dashboard_svg" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="./orders.php" class="nav-link link-dark active">
                                    <svg class="bi me-2" width="16" height="16">
                                        <use xlink:href="#cart" />
                                    </svg>
                                    Transaction
                                </a>
                            </li>
                            <li>
                                <a href="./product.php" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16">
                                        <use xlink:href="#grid" />
                                    </svg>
                                    Products
                                </a>
                            </li>
                            <li>
                                <a href="./report.php" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16">
                                        <use xlink:href="#chat-quote-fill" />
                                    </svg>
                                    Report
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="navbar-menu-wrapper d-flex align-items-top justify-content-between">
                <div class="navbar-nav">
                    <div class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold"><?= $admin['nama'] ?></span></h1>
                        <h3 class="welcome-sub-text">Your performance summary this week </h3>
                    </div>
                </div>
                <div class="ms-auto d-flex align-items-center">
                    <div class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../images/user_24px_black.png" alt="Profile image">
                        </a>
                    </div>
                    <div class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="../logout.php" style="display: flex; align-items: center; flex-direction: row;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16" style="color: #2a4bc0;">
                                <path d="M7.5 1v7h1V1h-1z" />
                                <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                            </svg>
                            <span style="margin-top: 0.5vh;">
                                Sign Out
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="navbar-menu-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Order</h4>
                        <div class="dashboard_btn">
                            <label for="searchID">Order ID : </label>
                            <input type="number" name="searchID" id="searchID" style="border: 1px solid lightgray; border-radius: 5px;">
                            <button class='btn btn-secondary' onclick="searchBtn()" style='margin:0; background-color: #d4e1ed;'>
                                <svg class="bi me-2" width="10" height="10">
                                    <use xlink:href="#search" />
                                </svg>
                            </button>
                            <button class='btn btn-success' onclick="viewAll()" style='margin:0; background-color: #34B1AA;'>View All</button>
                        </div>
                        <div class="table-responsive" id="tableUpdate">
                            <table class="table table-hover" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>ID Payment</th>
                                        <th>Order ID</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="dashboard_btn">
                                    <?php foreach ($payment as $key => $value) { ?>
                                        <tr>
                                            <td><?= ($key+1) ?></td>
                                            <td><?= $value['order_id'] ?></td>
                                            <td><?= "Rp. " . number_format($value['gross_amount'], 0, ',', '.') . ",-" ?></td>
                                            <td>
                                                <?php 
                                                    if ($value['transaction_status'] == "settlement"){
                                                        echo "<button class='btn btn-success' style='cursor: default; margin:0; background-color: #34B1AA;'>Success</button>";
                                                    }
                                                    else if ($value['transaction_status'] == "pending"){
                                                        echo "<button class='btn btn-secondary' style='cursor: default; margin:0; background-color: #d4e1ed;'>Pending</button>";
                                                    }
                                                    else{
                                                        echo "<button class='btn btn-danger' style='cursor: default; margin:0; background-color: #F95F53;'>Expired</button>";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <button class='btn btn-success' id="<?= $value['id'] ?>" onclick="showDetail(this)" style='margin:0; background-color: #34B1AA;'>Details</button>
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
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 1.5em; margin: 0;">&times;</button>
                    <h4 class="modal-title">Order Detail</h4>
                </div>
                <div class="modal-body" id="form_edit">

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
    <script>
        function searchBtn(){
            var order_id = $("#searchID").val();
            $.ajax({
                type:"post",
                url:"./ajax.php",
                data:{
                    'action':'search',
                    'order_id' : order_id
                },
                success:function(response){
                    $("#tableUpdate").html("");
                    $("#tableUpdate").html(response);
                }
            });
        }
        function showDetail(obj){
            var id_payment = $(obj).attr("id");
            $.ajax({
                type:"post",
                url:"./ajax.php",
                data:{
                    'action':'showDetail',
                    'id_payment' : id_payment
                },
                success: function(data) {
                    $('#form_edit').html(data);
                    $('#editModal').modal('show');
                }
            });
        }
        function viewAll(){
            $.ajax({
                type:"post",
                url:"./ajax.php",
                data:{
                    'action':'viewAll'
                },
                success:function(response){
                    $("#tableUpdate").html("");
                    $("#tableUpdate").html(response);
                }
            });
        }
        $(document).ready(function() {
            $(document).on('click', '.close', function() {
                $('#editModal').modal('hide');
            });
        });
    </script>
</body>

</html>