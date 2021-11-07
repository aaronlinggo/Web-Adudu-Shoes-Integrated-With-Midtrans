<?php
session_start();
require_once("../controller/connection.php");


if (!isset($_SESSION['active'])) {
  header('Location: index.php');
}
else{
  $id_user = $_SESSION['active'];
}
$stmt = $conn->prepare("SELECT * FROM users WHERE id_user=$id_user");
$stmt->execute();
$admin = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

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
                  header("Location: product.php");
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="images/favicon.png" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="index.html">
            Adudu
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="images/logo-mini.svg" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold"><?= $admin[0]['nama'] ?></span></h1>
            <h3 class="welcome-sub-text">Your performance summary this week </h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="Profile image">
            </a>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="../logout.php">
              <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
      </div>
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="product.php">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Products</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">Report</span>
            </a>
          </li>
        </ul>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Add New Shoes</h4>
                            <form class="form-sample" method="POST" action="" enctype="multipart/form-data">
                              <div class="row">
                                <div class="form-group row">
                                  <label for="shoesName" class="col-sm-3 col-form-label">Shoes Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" name="shoesName" id="shoesName" placeholder="Shoes Name">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="priceShoes" class="col-sm-3 col-form-label">Price</label>
                                  <div class="col-sm-9">
                                    <input type="number" class="form-control" name="priceShoes" id="priceShoes" placeholder="Price">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="subDesc" class="col-sm-3 col-form-label">Sub Description</label>
                                  <div class="col-sm-9">
                                    <textarea class="form-control" name="subDesc" id="subDesc" style="height: 100px;"></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="descShoes" class="col-sm-3 col-form-label">Description</label>
                                  <div class="col-sm-9">
                                    <textarea class="form-control" name="descShoes" id="descShoes" style="height: 100px;"></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="sizeShoes" class="col-sm-3 col-form-label">Size</label>
                                  <div class="col-sm-9">
                                    <input type="number" class="form-control" name="sizeShoes" id="sizeShoes" placeholder="Size">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="stockShoes" class="col-sm-3 col-form-label">Stock</label>
                                  <div class="col-sm-9">
                                    <input type="number" class="form-control" name="stockShoes" id="stockShoes" placeholder="Stock">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="imagesShoes" class="col-sm-3 col-form-label">Images</label>
                                  <div class="col-sm-9">
                                    <input type="file" class="form-control" name="imagesShoes" id="imagesShoes">
                                  </div>
                                </div>
                              </div>
                              <button class="btn btn-primary" style="color: white;" name="add">Submit</button>
                              <button class="btn btn-light">Reset</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 grid-margin stretch-card">
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
                                <tbody>
                                  <?php foreach ($sepatu as $key => $value) { ?>
                                    <tr>
                                      <td><?= $value['id_sepatu'] ?></td>
                                      <td><?= $value['nama_sepatu'] ?></td>
                                      <td><?= $value['size_sepatu'] ?></td>
                                      <td><?= $value['stock_sepatu'] ?></td>
                                      <td><?= "Rp. " . number_format($value['harga_sepatu'], 0, ',', '.') . ",-" ?></td>
                                      <td>
                                        <div class="d-flex">
                                          <div>
                                            <button class="btn btn-success edit_data" name="edit" id="<?= $value['id_sepatu'] ?>">Edit</button>
                                          </div>
                                          <form action="" method="post">
                                            <input type="hidden" name="id_sepatu" value="<?= $value['id_sepatu'] ?>">
                                            <button class="btn btn-danger" name="delete">Delete</button>
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
                    </div>
                  </div>
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
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Shoes</h4>
            </div>
            <div class="modal-body" id="form_edit">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

      //Begin Aksi Delete Data
      $(document).on('click', '.hapus_data', function() {
        var employee_id = $(this).attr("id");
        $.ajax({
          url: "delete.php",
          method: "POST",
          data: {
            employee_id: employee_id
          },
          success: function(data) {
            $('#employee_table').html(data);
          }
        });
      });
    });
  </script>
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
</body>

</html>