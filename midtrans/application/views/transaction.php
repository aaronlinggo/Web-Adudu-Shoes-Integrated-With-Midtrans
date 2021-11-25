<?php
	session_start();
	require_once("../controller/connection.php");

	$id_user = $_SESSION['active'];
	$stmt = $conn -> prepare("SELECT * FROM users WHERE id_user = $id_user");
	$stmt -> execute();
	$u = $stmt -> get_result() -> fetch_assoc();

	$stmt = $conn -> prepare("SELECT * FROM order_details WHERE user_id = $id_user ORDER BY id_order_details DESC");
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
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
		<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<SB-Mid-client-3OxJRhBsnTXSca5E>"></script>
	</head>
	<body class="main-layout" id="profile">
		<div class="col-md-12" style="padding: 0;">
			<div class="d-flex flex-row-reverse">
				<button id="checkUpdate" class="btn btn-dark" style="border: 0; margin: 0; margin-bottom: 5px; font-size: 14px!important;"><a href="./profile.php" style="color: inherit; text-decoration: none; width: 100%;">Check for Updates Here!</a></button>
			</div>
			<div class="flex flex-column w-100" style="min-height: 150px;">
				<?php
					foreach($order_details as $key => $value) {
						$id_payment = $value['payment_id'];
						$stmt = $conn -> prepare("SELECT * FROM payment WHERE id = '$id_payment'");
						$stmt -> execute();
						$payment = $stmt -> get_result() -> fetch_assoc();
						?>
							<div class="history-card flex-center border-radius-medium w-100">
								<div class="sidenumber flex-center">
									<?= ($key + 1) ?>
								</div>
								<div class="sideline w-100 flex flex-hcenter flex-column">
									<div class=" w-100 flex-center flex-between">
										<span class="payment-text flex-center flex-between" style="font-weight: 600;">Order ID: #<?= $payment['order_id'] ?></span>
										<span class="flex-center flex-between">
										<?php
											if($payment['transaction_status'] == "settlement") {
											?>
												<div class="status-btn flex-center border-radius-small" style="background-color: rgb(214, 255, 222); color: rgb(3, 172, 14); margin: 0; margin-left: 32px; padding: 4px;">Done</div>
											<?php
											} else if($payment['transaction_status'] == "expire") {
											?>
												<div class="status-btn flex-center border-radius-small" style="background-color: rgb(255, 234, 239); color: rgb(239, 20, 74); margin: 0; margin-left: 32px; padding: 4px;">Expired</div>
											<?php
											} else {
											?>
												<button class="status-btn btn btn-success" id="<?= $payment['id'] ?>" onclick="payNow(this)" style="color: white; font-size: 14px; margin: 0; margin-left: 32px; padding: 4px;">Pay!</button>
											<?php
											}
										?>
										</span>
									</div>
									<div class="payment-text flex flex-vcenter">
										Rp.&nbsp;<span class="flex-center" style="color: #ff4e5b;"><?= number_format($payment['gross_amount'], 0, ',', '.') ?>
									</div>
									<button class="status-btn btn btn-info" id="<?= $payment['id'] ?>" onclick="showDetail(this)" style="background-color: #34b1aa; margin: 0; margin-top: 15px;">Details</button>
								</div>
							</div>
						<?php
					}
				?>
			</div>
		</div>
		<form action="<?= site_url() ?>/transaction" method="POST" id="frm">
			<button id="updatepage" style="display: none;">Click</button>
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
		<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
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
