<?php
session_start();
require_once("../controller/connection.php");


if (!isset($_SESSION['active'])) {
    header('Location: index.php');
} else {
    $id_user = $_SESSION['active'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id_user=$id_user");
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();
    if ($admin['roles'] != "admin"){
        header('Location: ../index.php');
    }
}

$stmt = $conn->prepare("SELECT * FROM sepatu");
$stmt->execute();
$sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $shoesName = $_POST['shoesName'];
        $priceShoes = $_POST['priceShoes'];
        $subDesc = $_POST['subDesc'];
        $descShoes = $_POST['descShoes'];
        $sizeShoes = $_POST['sizeShoes'];
        $stockShoes = $_POST['stockShoes'];
        $imagesShoes = $_FILES['imagesShoes'];
        //ALERT GA MUNCUL BABI
        if (!empty($shoesName)) {
            if ($priceShoes > 0) {
                if ($descShoes != "") {
                    if ($subDesc != "") {
                        if ($sizeShoes > 0) {
                            if ($stockShoes > 0) {
                                if ($imagesShoes['name'] != "") {
                                    foreach ($sepatu as $key => $value) {
                                        $id = (int)$value['id_sepatu'];
                                    }

                                    if (!isset($id)) {
                                        $id = 0;
                                    }
                                    $lokasi = "list_products/";

                                    @mkdir($lokasi);

                                    move_uploaded_file($_FILES['imagesShoes']['tmp_name'], $lokasi . ($id + 1) . '.jpg');
                                    $temp = $lokasi . ($id + 1) . '.jpg';
                                    $stmt = $conn->prepare("INSERT INTO sepatu(nama_sepatu, harga_sepatu, sub_desc, desc_sepatu, size_sepatu, stock_sepatu, link_gambarsepatu) VALUES(?,?,?,?,?,?,?)");
                                    $stmt->bind_param("sissiis", $shoesName, $priceShoes, $subDesc, $descShoes, $sizeShoes, $stockShoes, $temp);
                                    $result = $stmt->execute();
                                    echo "<script>alert('Success Add Shoes')</script>";
                                    echo "<script>window.location = './product.php'</script>";
                                } else {
                                    echo "<script>alert('Please choose an image')</script>";
                                }
                            } else {
                                echo "<script>alert('Stock must be more than 0')</script>";
                            }
                        } else {
                            echo "<script>alert('Size must be more than 0')</script>";
                        }
                    } else {
                        echo "<script>alert('Sub Description cant be Empty')</script>";
                    }
                } else {
                    echo "<script>alert('Description can't be empty')</script>";
                }
            } else {
                echo "<script>alert('Prize must be more than 0')</script>";
            }
        } else {
            echo "<script>alert('Shoes Name can't be empty')</script>";
        }
    }
    if (isset($_POST['delete'])) {
        $id_sepatu = $_POST["id_sepatu"];
        $result = $conn->query("DELETE FROM sepatu WHERE id_sepatu=$id_sepatu");
        echo "<script>alert('Success Delete Shoes ID $id_sepatu')</script>";
        header('Location: product.php');
    }
}
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
                                <a href="./orders.php" class="nav-link link-dark">
                                    <svg class="bi me-2" width="16" height="16">
                                        <use xlink:href="#cart" />
                                    </svg>
                                    Transaction
                                </a>
                            </li>
                            <li>
                                <a href="./product.php" class="nav-link link-dark active">
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
                        <h4 class="card-title">Add New Shoes</h4>
                        <form class="form-sample dashboard_btn" method="POST" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group row" style="margin-top: 0;">
                                    <label for="shoesName" class="col-sm-3 col-form-label">Shoes Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="shoesName" id="shoesName" placeholder="Shoes Name">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 0;">
                                    <label for="priceShoes" class="col-sm-3 col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="priceShoes" id="priceShoes" placeholder="Price">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 0;">
                                    <label for="subDesc" class="col-sm-3 col-form-label">Sub Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="subDesc" id="subDesc" style="height: 100px;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 0;">
                                    <label for="descShoes" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="descShoes" id="descShoes" style="height: 100px;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 0;">
                                    <label for="sizeShoes" class="col-sm-3 col-form-label">Size</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="sizeShoes" id="sizeShoes" placeholder="Size">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 0;">
                                    <label for="stockShoes" class="col-sm-3 col-form-label">Stock</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="stockShoes" id="stockShoes" placeholder="Stock">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 0;">
                                    <label for="imagesShoes" class="col-sm-3 col-form-label">Images</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="imagesShoes" id="imagesShoes">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" style="color: white; background-color: #1f3bb3;" name="add">Submit</button>
                            <button class="btn btn-light"><a href="product.php" style="text-decoration: none; color: inherit;">Reset</a></button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Products</h4>
                        <div class="table-responsive" id="tableUpdate">
                            <table class="table table-hover" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Shoes ID</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Stock</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="dashboard_btn">
                                    <?php foreach ($sepatu as $key => $value) { ?>
                                        <tr>
                                            <td><?= $value['id_sepatu'] ?></td>
                                            <td><?= $value['nama_sepatu'] ?></td>
                                            <td><?= $value['size_sepatu'] ?></td>
                                            <td>
                                                <?php
                                                if ($value['stock_sepatu'] > 0) {
                                                    echo $value['stock_sepatu'];
                                                } else {
                                                    echo "<p class='red-500'>Out of Stock</p>";
                                                }
                                                ?>
                                            </td>
                                            <td><?= "Rp. " . number_format($value['harga_sepatu'], 0, ',', '.') . ",-" ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <div>
                                                        <button class="btn btn-success edit_data" name="edit" id="<?= $value['id_sepatu'] ?>" style="background-color: #32aba4;">Edit</button>
                                                    </div>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_sepatu" value="<?= $value['id_sepatu'] ?>">
                                                        <button class="btn btn-danger" name="delete" style="background-color: #f95f53;">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="editModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" style="font-size: 1.5em; margin: 0;">&times;</button>
                            <h4 class="modal-title">Edit Shoes</h4>
                        </div>
                        <div class="modal-body" id="form_edit">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            //Begin Tampil Form Edit
            $(document).on('click', '.edit_data', function() {
                var id_sepatu = $(this).attr("id");
                $.ajax({
                    url: "edit.php",
                    method: "POST",
                    data: {
                        id_sepatu: id_sepatu
                    },
                    success: function(data) {
                        $('#form_edit').html(data);
                        $('#editModal').modal('show');
                    }
                });
            });

            $(document).on('click', '.close', function() {
                $('#editModal').modal('hide');
            });
        });
    </script>
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