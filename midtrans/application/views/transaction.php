<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_adudu';
$port = '3306';
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_errno) {
	die("gagal connect : " . $conn->connect_error);
}
//var_dump($_SESSION);
$id_user = $_SESSION['active'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id_user=$id_user");
$stmt->execute();
$u = $stmt->get_result()->fetch_assoc();

$stmt = $conn->prepare("SELECT * FROM order_details WHERE user_id=$id_user");
$stmt->execute();
$order_details = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['delete'])) {
		$id_cart = $_POST['id_cart'];
		$result = $conn->query("DELETE FROM cart_item WHERE id_cart=$id_cart");
		header('Location: cart.php');
	}
}

?>

<html>

<head>
	<title>History | Adudu Shoes</title>
	<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<SB-Mid-client-3OxJRhBsnTXSca5E>"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<meta http-equiv="X-UA-Compatible" charset="UTF-8" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../images/logo.png" type="image/png">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="../../css/responsive.css">
	<link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="../../css/owl.carousel.min.css">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

	<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<SB-Mid-client-3OxJRhBsnTXSca5E>"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body class="main-layout">
	<div class="header_section">
		<div class="container" style="height: auto;">
			<div class="row flex-row">
				<div class="col-sm-3 flex flex-vstart">
					<div class="logo">
						<a href="../../index.php">
							<img class="top-logo" src="../../images/logo.png">
						</a>
					</div>
				</div>
				<div class="col-sm-9">
					<nav class="navbar navbar-expand-lg navbar-light bg-light flex flex-hend fullheight">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse flex-between" id="navbarNavAltMarkup">
							<div class="navbar-nav flex-vcenter" style="align-items: center;">
								<a class="nav-item nav-link" href="../../index.php">Home</a>
								<a class="nav-item nav-link" href="../../collection.php">Collection</a>
								<a class="nav-item nav-link" href="../../shoes.php">Shoes</a>
								<div id="search_icon" class="nav-item nav-link last flex-center" style="cursor: pointer; position: relative;">
									<img src="../../images/search_icon_black.png">
									<div id="search_area" style="position: absolute; top: 80px; left: 30px; display: none;" class="flex">
										<!-- <form action="" method=""> -->
										<input type="text" name="search" id="search">
										<button name="search_btn" id="search_btn" style="margin-left: 10px;">Search</button>
										<!-- </form> -->
									</div>
								</div>
								<!-- <a class="nav-item nav-link last flex-center" href="#">
                            <img src="./images/search_icon_black.png">
                        </a> -->
								<a class="nav-item nav-link last flex-center" href="
                        <?php
						if (!isset($_SESSION['active'])) {
							echo "../../login.php";
						} else {
							echo "../index.php/snap";
						}
						?>
                        ">
									<img src="../../images/shop_icon_black.png">
									<?php
									if (isset($_SESSION['active'])) {
									?>
										<span class="top-0 start-100 translate-middle badge rounded-pill bg-danger">
											<?php
											$id_user = $_SESSION['active'];
											$stmt = $conn->prepare("SELECT count(*) as 'total' FROM cart_item WHERE user_id = $id_user AND active = 1");
											$stmt->execute();
											$cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
											echo $cart[0]['total'];
											?>
										</span>
									<?php
									}
									?>
								</a>
							</div>
							<div class="navbar-nav flex-vcenter" style="align-items: center;">
								<?php
								if (!isset($_SESSION['active'])) {
								?>
									<a class="role-out btn btn-outline-success fullheight" href="../../login.php">Sign In</a>
									<a class="role-out btn btn-outline-danger fullheight" href="../../register.php">Sign Up</a>
								<?php
								} else {
								?>
									<a class="nav-item nav-link" href="#">
										<img src="../../images/user_24px_black.png">
									</a>
									<a class="btn btn-outline-danger fullheight" href="../../logout.php">Sign Out</a>
								<?php
								}
								?>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>

	</div>
	<div class="collection_text">History Transaction</div>
	<div class="layout_padding contact_section">
		<div class="container-fluid ram">
			<div class="row">
				<div class="col-md-12">
					<div class="d-flex flex-row-reverse" style="padding: 0 1vw;">
						<button class="btn btn-success"><a href="./transaction" style="text-decoration: none; color:inherit">Check for Updates!</a></button>
					</div>
					<table class="table table-hover" style="text-align: center;">
						<thead>
							<tr>
								<th>No.</th>
								<th>Order ID</th>
								<th>Subtotal</th>
								<th>Status</th>
								<th>See Order</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$item_details = array();
							foreach ($order_details as $key => $value) {
								$id_payment = $value['payment_id'];
								$stmt = $conn->prepare("SELECT * FROM payment WHERE id='$id_payment'");
								$stmt->execute();
								$payment = $stmt->get_result()->fetch_assoc();
							?>
								<tr>
									<td><?= ($key + 1) ?>
									</td>
									<td>
										<?= $payment['order_id'] ?>
									</td>
									<td>
										<?= "Rp. " . number_format($payment['gross_amount'], 0, ',', '.') . ",-" ?>
									</td>
									<td>
										<?php 
										if ($payment['transaction_status'] == "settlement"){
										?>
											<div class="btn btn-success">Done</div>
										<?php
										}
										else if ($payment['transaction_status'] == "expire"){
										?>
											<div class="btn btn-danger">Expired</div>
										<?php
										}
										else{
										?>
											<button class="btn btn-success">Pay!</button>
										<?php
										}
										?>
									</td>
									<td>
										<button class="btn btn-info">Details</button>
									</td>
								</tr>
							<?php  } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<form action="<?= site_url() ?>/transaction" method="POST" id="frm">
		<button id="updatepage" style="display: none;">klik</button>
	</form>

	<div class="copyright">2021 All Rights Reserved | <a href="./">Adudu Shoes</a></div>

	<script src="../../js/jquery.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.bundle.min.js"></script>
	<script src="../../js/jquery-3.0.0.min.js"></script>
	<script src="../../js/plugin.js"></script>
	<script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="../../js/custom.js"></script>
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

			// Scroll slides on android swipes
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