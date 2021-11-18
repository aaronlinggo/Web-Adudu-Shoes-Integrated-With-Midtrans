<?php
	session_start();
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'db_adudu';
	$port = '3306';
	$conn = new mysqli($host, $user, $password, $database);

	if($conn -> connect_errno) {
		die("Gagal Connect: " . $conn -> connect_error);
	}

	//var_dump($_SESSION);
	$id_user = $_SESSION['active'];
	$stmt = $conn -> prepare("SELECT * FROM users WHERE id_user = $id_user");
	$stmt -> execute();
	$u = $stmt -> get_result() -> fetch_assoc();

	$stmt = $conn -> prepare("SELECT * FROM order_details WHERE user_id = $id_user");
	$stmt -> execute();
	$order_details = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['delete'])) {
			$id_cart = $_POST['id_cart'];
			$result = $conn -> query("DELETE FROM cart_item WHERE id_cart = $id_cart");
			header('Location: cart.php');
		}
	}
?>

<html lang="en-US">
	<head>
		<!-- <title>History | Adudu Shoes</title> -->
		<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<SB-Mid-client-3OxJRhBsnTXSca5E>"></script>
		<meta http-equiv="X-UA-Compatible" charset="UTF-8" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<link rel="icon" href="./images/logo.png" type="image/png">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/responsive.css">
		<link rel="stylesheet" href="./css/jquery.mCustomScrollbar.min.css">
		<link rel="stylesheet" href="./css/owl.carousel.min.css">
		<link rel="stylesheet" href="./admin/style.css">
		<!-- <link rel="icon" href="../../images/logo.png" type="image/png">
		<link rel="stylesheet" href="../../css/bootstrap.min.css">
		<link rel="stylesheet" href="../../css/style.css">
		<link rel="stylesheet" href="../../css/responsive.css">
		<link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css">
		<link rel="stylesheet" href="../../css/owl.carousel.min.css"> -->
		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
		<!-- <link rel="stylesheet" href="../../admin/style.css"> -->
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
		<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<SB-Mid-client-3OxJRhBsnTXSca5E>"></script>
	</head>
	<body class="main-layout">
		<div class="collection_text">History Transaction</div>
		<div class="contact_section">
			<div class="container-fluid ram">
				<div class="row">
					<div class="col-md-12">
						<div class="d-flex flex-row-reverse" style="padding: 0 1vw;">
							<button class="btn btn-success"><a href="./profile.php" style="text-decoration: none; color:inherit">Check for Updates!</a></button>
						</div>
						<table class="table table-hover dashboard_btn" style="text-align: center;">
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

								foreach($order_details as $key => $value) {
									$id_payment = $value['payment_id'];
									$stmt = $conn -> prepare("SELECT * FROM payment WHERE id = '$id_payment'");
									$stmt -> execute();
									$payment = $stmt -> get_result() -> fetch_assoc();
									?>
										<tr>
											<td><?= ($key + 1) ?></td>
											<td><?= $payment['order_id'] ?></td>
											<td><?= "Rp. " . number_format($payment['gross_amount'], 0, ',', '.') . ",-" ?></td>
											<td>
												<?php
													if($payment['transaction_status'] == "settlement") {
													?>
														<button class="btn btn-success" style="margin: 0; cursor: default; color: white;">Done</button>
													<?php
													} else if($payment['transaction_status'] == "expire") {
													?>
														<button class="btn btn-danger" style="margin: 0; cursor: default; background-color: #F95F53;">Expired</button>
													<?php
													} else {
													?>
														<button class="btn btn-success" id="<?= $payment['id'] ?>" onclick="payNow(this)" style="margin: 0; color: white;">Pay!</button>
													<?php
													}
												?>
											</td>
											<td>
												<button class='btn btn-info' id="<?= $payment['id'] ?>" onclick="showDetail(this)" style='margin:0; background-color: #34B1AA;'>Details</button>
											</td>
										</tr>
									<?php 
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<form action="<?= site_url() ?>/transaction" method="POST" id="frm">
			<button id="updatepage" style="display: none;">Klik</button>
		</form>
		<div id="editModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" style="font-size: 1.5em; margin: 0;">&times;</button>
						<h4 class="modal-title">Order Detail</h4>
					</div>
					<div class="modal-body" id="form_edit"></div>
				</div>
			</div>
		</div>
		<script>
			function showDetail(obj) {
				var id_payment = $(obj).attr("id");
				$.ajax({
					type: "post",
					url: "admin/ajax.php",
					// url: ".../../../../admin/ajax.php",
					data: {
						'action': 'showDetail_user',
						'id_payment': id_payment
					},
					success: function(data) {
						$('#form_edit').html(data);
						$('#editModal').modal('show');
					}
				});
			}

			function payNow(obj) {
				var id_payment = $(obj).attr("id");
				$.ajax({
					type: "post",
					url: "./admin/ajax.php",
					// url: ".../../../../admin/ajax.php",
					data: {
						'action': 'payNow',
						'id_payment': id_payment
					},
					success: function(data) {
						$('#form_edit').html(data);
						$('#editModal').modal('show');
					}
				});
			}

			$(document).ready(function() {
				$(document).on('click', '.close', function() {
					$('#editModal').modal('hide');
				});
			});
		</script>
		<script src="./js/jquery.min.js"></script>
		<script src="./js/popper.min.js"></script>
		<script src="./js/bootstrap.bundle.min.js"></script>
		<script src="./js/jquery-3.0.0.min.js"></script>
		<script src="./js/plugin.js"></script>
		<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="./js/custom.js"></script>
		<!-- <script src="../../js/jquery.min.js"></script>
		<script src="../../js/popper.min.js"></script>
		<script src="../../js/bootstrap.bundle.min.js"></script>
		<script src="../../js/jquery-3.0.0.min.js"></script>
		<script src="../../js/plugin.js"></script>
		<script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="../../js/custom.js"></script> -->
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

						if(Math.floor(yClick - yMove) > 1) {
							$(".carousel").carousel('next');
						} else if(Math.floor(yClick - yMove) < -1) {
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
