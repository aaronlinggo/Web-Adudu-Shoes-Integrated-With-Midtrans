<?php
	session_start();

	// $host = 'localhost';
	// $user = 'root';
	// $password = '';
	// $database = 'db_adudu';
	// $port = '3306';
	// $conn = new mysqli($host, $user, $password, $database);

	// if($conn->connect_errno) {
	//   die("Gagal Connect: " . $conn->connect_error);
	// }

	require_once("./application/controllers/connection.php");

	$id_user = $_SESSION['active'];
	$stmt = $conn->prepare("SELECT * FROM users WHERE id_user=$id_user");
	$stmt->execute();
	$u = $stmt->get_result()->fetch_assoc();

	$stmt = $conn->prepare("SELECT * FROM cart_item WHERE user_id=$id_user and active = 1");
	$stmt->execute();
	$cart_item = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['delete'])) {
			$id_cart = $_POST['id_cart'];
			$result = $conn->query("DELETE FROM cart_item WHERE id_cart=$id_cart");
			header('Location: snap');
		}
	}
?>

<html lang="en-US">
	<head>
		<title>Shopping Cart | Adudu Shoes</title>
		<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<SB-Mid-client-3OxJRhBsnTXSca5E>"></script>
		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
		<!-- <meta http-equiv="X-UA-Compatible" charset="UTF-8" content="IE=edge">
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
		<meta http-equiv="X-UA-Compatible" charset="UTF-8" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="author" content="">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<link rel="icon" href="../../images/logo.png" type="image/png">
		<link rel="stylesheet" href="../../css/bootstrap.min.css">
		<link rel="stylesheet" href="../../css/style.css">
		<link rel="stylesheet" href="../../css/responsive.css">
		<link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css">
		<link rel="stylesheet" href="../../css/owl.carousel.min.css">
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
	</head>
	<body class="main-layout">
		<div class="header-section">
			<div class="header-inner container h-auto">
				<div class="row flex-row" style="position: relative;">
					<div class="col-sm-12">
						<nav class="navbar navbar-expand-lg navbar-light bg-light flex flex-hend flex-between fullheight">
							<div class="logo">
								<a href="../../index.php" class="flex flex-hstart">
									<img class="top-logo" src="../../images/logo_2.png">
								</a>
							</div>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
								<div class="navbar-nav flex flex-row flex-between flex-vcenter fullwidth">
									<div class="medium-scale flex flex-between">
										<a class="nav-item nav-link nav-android-menu" href="../../index.php">Home</a>
										<a class="nav-item nav-link nav-android-menu" href="../../aboutus.php">About</a>
										<a class="nav-item nav-link nav-android-menu" href="../../shoes.php">Shoes</a>
										<a class="nav-item nav-link nav-android-menu last" href="#">Search</a>
										<a class="nav-item nav-link nav-android-menu last" href='<?= (!isset($_SESSION['active'])) ? "../../login.php" : "./midtrans/index.php/snap" ?>'>Cart</a>
										<div id="search_icon" class="nav-item nav-link last flex-center" style="cursor: pointer; position: relative;">
											<img id="search_img" src="../../images/search_icon_black.png">
										</div>
										<a class="nav-item nav-link last flex-center" href='<?= (!isset($_SESSION['active'])) ? "../../login.php" : "./snap" ?>' style="position: relative;">
											<img src="../../images/shop_icon_black_2.png">
										</a>
									</div>
									<?php
									if(!isset($_SESSION['active'])) {
									?>
										<div class="medium-scale flex flex-vcenter flex-between">
										<?php
									} else {
										?>
											<div class="medium-scale flex flex-vcenter flex-hend">
											<?php
										}

										if(!isset($_SESSION['active'])) {
											?>
												<a class="role-out btn btn-outline-success fullheight" href="../../login.php">Sign In</a>
												<a class="role-out btn btn-outline-danger fullheight" href="../../register.php">Sign Up</a>
												<?php
											} else {
												if(isset($_SESSION['activeRoles'])) {
													if($_SESSION['activeRoles'] == "Customer") {
												?>
														<a class="nav-item nav-link profile flex flex-hend" href="../../profile.php">
															<img src="../../images/user_24px_black.png">
														</a>
													<?php
													} else if($_SESSION['activeRoles'] == "admin") {
													?>
														<a class="nav-item nav-link profile flex flex-hend" href="../../admin/index.php">
															<img src="../../images/user_24px_black.png">
														</a>
												<?php
													}
												}
												?>
													<a class="btn btn-outline-danger fullheight" href="../../logout.php">Sign Out</a>
											<?php
											}
										?>
										</div>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="collection_text">Cart</div>
		<div class="layout_padding contact_section">
			<div class="container-fluid ram">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover" style="text-align: center;">
							<thead>
								<tr>
									<th>No.</th>
									<th>Shoes Name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Subtotal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="updateQty">
							<?php $amount = 0;
								$item_details = array();
								foreach ($cart_item as $key => $value) {
									$amount += ($value['price'] * $value['qty']);
									?>
										<tr>
											<td><?= ($key + 1) ?>
											</td>
											<td>
												<?php
													$sepatu_id = $value['sepatu_id'];

													$stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu=$sepatu_id");
													$stmt->execute();
													$sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
													if(strlen($sepatu[0]['nama_sepatu']) > 25)
														$nama_sepatu = substr($sepatu[0]['nama_sepatu'], 0, 25);
													else {
														$nama_sepatu = $sepatu[0]['nama_sepatu'];
													}
													$item1_details = array(
														'id' => $sepatu_id,
														'price' => $value['price'],
														'quantity' => $value['qty'],
														'name' => $nama_sepatu
													);

												array_push($item_details, $item1_details);
												echo $sepatu[0]['nama_sepatu'];
											?>
										</td>
										<td><?= "Rp. " . number_format($value['price'], 0, ',', '.') . ",-" ?></td>
										<td class="d-flex justify-content-center">
											<button class="btn btn-secondary" onclick="kurang(<?= $value['id_cart'] ?>, <?= $id_user ?>)">-</button>
											<input type="text" name="" id="totqty" class="form-control" style="width: 35px;" value="<?= $value['qty'] ?>" disabled>
											<button class="btn btn-secondary" onclick="tambah(<?= $value['id_cart'] ?>, <?= $id_user ?>)">+</button>
										</td>
										<td><?= "Rp. " . number_format(($value['price'] * $value['qty']), 0, ',', '.') . ",-" ?></td>
										<td>
											<div class="d-flex justify-content-center">
												<div style="margin-right: 1vh;">
													<a href="../../<?= "detail_shoes.php?id_sepatu=" . $value['sepatu_id'] ?>">
														<button class="btn btn-success" style='margin:0; background-color: #34B1AA;'>Details</button>
													</a>
												</div>
												<form action="" method="post">
													<input type="hidden" name="id_cart" value="<?= $value['id_cart'] ?>">
													<button class="btn btn-danger" name="delete" style="margin: 0; background-color: #F95F53;">Delete</button>
												</form>
											</div>
										</td>
									</tr>
								<?php  } ?>
								<tr class="bg-secondary text-white align-self-center">
									<td colspan="4">
										<div style="float: right;">
											Subtotal :
										</div>
									</td>
									<td>
										<?= "Rp. " . number_format($amount, 0, ',', '.') . ",-" ?>
									</td>
									<td>
										<form style="margin: 0;">
											<input type="hidden" id="user" name="user" value='<?= json_encode($u) ?>'>
											<input type="hidden" id="cart_item" name="cart_item" value='<?= json_encode($item_details) ?>'>
											<input type="hidden" id="amount" name="amount" value='<?= $amount ?>'>
											<button class="btn btn-success" id="pay-button" name="payment">Payment</button>
										</form>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<form id="payment-form" method="post" action="./snap/finish">
			<!-- <form id="payment-form" method="post" action="<?= site_url() ?>/transaction"> -->
			<!-- <form id="payment-form" method="post" action="./transaction"> -->
			<input type="hidden" name="result_type" id="result-type" value=""></div>
			<input type="hidden" id="userid" name="userid" value='<?= $u['id_user'] ?>'>
			<input type="hidden" name="result_data" id="result-data" value=""></div>
		</form>
		<div style="clear: both;"></div>
		<div class="copyright">
			<div class="copyright-padding fullwidth flex" style="flex-wrap: wrap;">
				<div class="col-sm-6 d-flex flex-column align-items-start p-0" style="text-align: left;">
					<div class="info-text font-bold">
						FOLLOW US ON
						<a href="https://github.com/aaronlinggo/Proyek-PW-Adudu.git" target="_blank"><img src="../../images/GitHub_Logo_White.png" alt="" style="width: 65px;"></a><br><br>
					</div>
				</div>
				<div class="col-sm-6 d-flex flex-column align-items-start p-0" style="text-align: left;">
					<div class="info-text" style="font-weight: normal;">
						Developed by :<br>
						<table>
							<tr class="align-middle">
								<td>Aaron</td>
								<td>&nbsp;&nbsp;-&nbsp;&nbsp;</td>
								<td>220116898</td>
								<td>&nbsp;&nbsp;<a href="#" target="_blank"><img srcset="../../images/linkedin.png" alt="" style="padding-bottom: 1px; max-height: 34px;"></a></td>
							</tr>
							<tr class="align-middle">
								<td>Samuel</td>
								<td>&nbsp;&nbsp;-&nbsp;&nbsp;</td>
								<td>220116928</td>
								<td>&nbsp;&nbsp;<a href="#" target="_blank"><img srcset="../../images/linkedin.png" alt="" style="padding-bottom: 1px; max-height: 34px;"></a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="copyright-border fullwidth"></div>
			<div class="copyright-padding fullwidth">2021 &copy; All Rights Reserved | <a href="./">Adudu Shoes</a></div>
		</div>
		<!-- <script src="./js/jquery.min.js"></script> -->
		<script src="../../js/jquery-3.6.0.min.js"></script>
		<script src="../../js/popper.min.js"></script>
		<script src="../../js/bootstrap.bundle.min.js"></script>
		<!-- <script src="./js/jquery-3.0.0.min.js"></script> -->
		<script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
		<!-- <script src="./js/plugin.js"></script>
		<script src="./js/custom.js"></script> -->
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
		<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
		<script>
			function tambah(id, id_user) {
				$.ajax({
					type: "POST",
					url: "../../controller/ajax.php",
					data: {
						'action': 'tambah',
						'id': id,
						'id_user': id_user
					},
					success: function(response) {
						$("#updateQty").html("");
						$("#updateQty").append(response);
					}
				});
			}

			function kurang(id, id_user) {
				$.ajax({
					type: "POST",
					url: "../../controller/ajax.php",
					data: {
						'action': 'kurang',
						'id': id,
						'id_user': id_user
					},
					success: function(response) {
						$("#updateQty").html("");
						$("#updateQty").append(response);
					}
				});
			}
		</script>
		<script type="text/javascript">
			$('#pay-button').click(function(event) {
				event.preventDefault();

				var cart_item = $("#cart_item").val();
				var amount = $("#amount").val();
				var user = $("#user").val();

				$.ajax({
					method: 'POST',
					url: './snap/token',
					data: {
						cart_item: cart_item,
						amount: amount,
						user: user
					},
					cache: false,
					success: function(data) {
						//location = data;
						console.log('token = ' + data);

						var resultType = document.getElementById('result-type');
						var userid = document.getElementById('userid').value;
						var resultData = document.getElementById('result-data');
						console.log(resultType);
						console.log(resultData);
						console.log(userid);

						function changeResult(type, data) {
							$("#result-type").val(type);
							$("#result-data").val(JSON.stringify(data));
							$("#userid").val(userid);
							//resultType.innerHTML = type;
							//resultData.innerHTML = JSON.stringify(data);
						}

						snap.pay(data, {
							onSuccess: function(result) {
								changeResult('success', result);
								console.log(result.status_message);
								console.log(result);
								$("#payment-form").submit();
							},
							onPending: function(result) {
								changeResult('pending', result);
								console.log(result.status_message);
								$("#payment-form").submit();
							},
							onError: function(result) {
								changeResult('error', result);
								console.log(result.status_message);
								$("#payment-form").submit();
							}
						});
					}
				});
			});
		</script>
	</body>
</html>
