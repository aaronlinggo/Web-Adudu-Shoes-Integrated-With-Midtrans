<?php
session_start();
require_once("../controller/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])){
        $shoesName = $_POST['shoesName'];
        $priceShoes = $_POST['priceShoes'];
        $descShoes = $_POST['descShoes'];
        $sizeShoes = $_POST['sizeShoes'];
        $imagesShoes = $_FILES['imagesShoes'];

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
            <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">Admin</span></h1>
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
            <a class="nav-link" href="../logout.php">
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
                            <form class="form-sample" method="POST" action="cek.php" enctype="multipart/form-data">
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
                            <div class="table-responsive">
                              <table class="table table-hover" style="text-align: center;">
                                <thead>
                                  <tr>
                                    <th>Shoes ID</th>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Stock</th>
                                    <th colspan="2">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>000001</td>
                                    <td>Adidas 1</td>
                                    <td>40</td>
                                    <td>99+</td>
                                    <td><button type="button" class="btn btn-success">Update</button></td>
                                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                                  </tr>
                                  <tr>
                                    <td>000001</td>
                                    <td>Adidas 1</td>
                                    <td>40</td>
                                    <td>99+</td>
                                    <td><button type="button" class="btn btn-success">Update</button></td>
                                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                                  </tr>
                                  <tr>
                                    <td>000001</td>
                                    <td>Adidas 1</td>
                                    <td>40</td>
                                    <td>99+</td>
                                    <td><button type="button" class="btn btn-success">Update</button></td>
                                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                                  </tr>
                                  <tr>
                                    <td>000001</td>
                                    <td>Adidas 1</td>
                                    <td>40</td>
                                    <td>99+</td>
                                    <td><button type="button" class="btn btn-success">Update</button></td>
                                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                                  </tr>
                                  <tr>
                                    <td>000001</td>
                                    <td>Adidas 1</td>
                                    <td>40</td>
                                    <td>99+</td>
                                    <td><button type="button" class="btn btn-success">Update</button></td>
                                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                                  </tr>
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