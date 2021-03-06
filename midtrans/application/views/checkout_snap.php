<?php
	session_start();
	require_once("./application/controllers/connection.php");

	$id_user = $_SESSION['active'];
	$stmt = $conn -> prepare("SELECT * FROM users WHERE id_user = $id_user");
	$stmt -> execute();
	$u = $stmt -> get_result() -> fetch_assoc();

	$stmt = $conn -> prepare("SELECT * FROM cart_item WHERE user_id = $id_user and active = 1");
	$stmt -> execute();
	$cart_item = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['delete'])) {
			$id_cart = $_POST['id_cart'];
			$result = $conn -> query("DELETE FROM cart_item WHERE id_cart = $id_cart");
			header('Location: snap');
		}
	}

	$stmt = $conn -> prepare("SELECT * FROM notification_handler WHERE id_user = $id_user and active = 1 ORDER BY ID DESC");
	$stmt -> execute();
	$notification_handler = $stmt -> get_result() -> fetch_assoc() ?? [];
?>

<html lang="en-US">
	<head>
		<title>Shopping Cart | Adudu Shoes</title>
		<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<SB-Mid-client-3OxJRhBsnTXSca5E>"></script>
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
	<body class="main-layout flex flex-column">
		<div id="header" class="header-section segment">
			<div class="header-inner container">
				<div class="row flex-row" style="position: relative;">
					<div class="landing-padding col-sm-12">
						<nav class="navbar navbar-expand-lg navbar-light bg-light flex flex-hend flex-between fullheight">
							<div class="logo">
								<a href="../../" class="flex flex-hstart">
									<img class="top-logo" src="../../images/logo_2.png">
								</a>
							</div>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle Navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
								<div class="navbar-nav flex flex-row flex-between flex-vcenter fullwidth">
									<div class="medium-scale flex flex-between">
										<a class="nav-item nav-link nav-android-menu" href="../../">Home</a>
										<a class="nav-item nav-link nav-android-menu" href="../../aboutus.php">About</a>
										<a class="nav-item nav-link nav-android-menu" href="../../shoes.php">Shoes</a>
										<a class="nav-item nav-link nav-android-menu last" href="../../shoes.php?input-search=true">Search</a>
										<a class="nav-item nav-link nav-android-menu last" href='<?= (!isset($_SESSION['active'])) ? "../../login.php" : "./snap" ?>'>Cart</a>
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
		<?php
            if (isset($notification_handler)){
                if (count($notification_handler)>0){
                    ?>
                    <div id="notifPopup" class="position-sticky" style="display: none;">
                        <div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong style="margin-right: auto;">Payment Notification</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">Your #<?= $notification_handler['order_id'] ?> transaction is <?php if ($notification_handler['status'] == 'expire') { echo "not"; } ?> complete.</div>
                        </div>
                    </div>
                    <script>
                        let notifTimer;
                        let calcHeaderHeight = $("#header").height() + 30;
    
                        $(document).ready(function() {
                            $(".btn-close").click(function(e) {
                                e.preventDefault();
                                clearTimeout(notifTimer);
    
                                $("#liveToast").removeClass("show");
                                $("#liveToast").addClass("hide");
    
                                setTimeout(() => {
                                    $("#notifPopup").removeAttr("style");
                                    $("#notifPopup").css({ "display": "none" });
                                }, 250);
                            });
                        });
                        $("#notifPopup").removeAttr("style");
                        $("#notifPopup").css({
                            "display": "block",
                            "top": calcHeaderHeight,
                            "right": "0",
                            "z-index": "99999"
                        });
    
                        clearTimeout(notifTimer);
    
                        setTimeout(() => {
                            $("#liveToast").removeClass("hide");
                            $("#liveToast").addClass("show");
                        }, 250);
    
                        notifTimer = setTimeout(() => {
                            $("#liveToast").removeClass("show");
                            $("#liveToast").addClass("hide");
    
                            setTimeout(() => {
                                $("#notifPopup").removeAttr("style");
                                $("#notifPopup").css({ "display": "none" });
                            }, 250);
                        }, 5000);
                    </script>
                    <?php
                    $id_notif = $notification_handler['id'];
                    $temp_active = 0;
                    $result = $conn -> query("update notification_handler set active = $temp_active where id = $id_notif");
                }
            }
        ?>
		<div id="cart-box" class="fullwidth h-auto flex flex-column" style="flex-grow: 1;">
			<div class="container landing-padding about h-auto flex-center catalog-main">
				<h1 class="title about-section m-0 mt-4 mt-sm-5 p-0 pt-3 pt-sm-2 font-bold" style="text-align: center;">SHOPPING CART</h1>
			</div>
			<div class="layout-padding about mb-5">
				<div class="placeholder-msg flex-center">Scroll to the bottom to pay</div>
				<div id="checkout-container" class="container landing-padding about h-auto flex-center flex-vstart">
					<div class="inner flex flex-column w-100">
						<?php
							$amount = 0;
							$item_details = array();

							if(count($cart_item) <= 0) {
							?>
								<div class="w-100 flex-center col-sm-12 py-4" style="font-size: 16pt; text-align: center;">Your cart is empty. Fill it with our awesome shoes!</div>
							<?php
							} else {
								foreach($cart_item as $key => $value) {
									$amount += ($value['price'] * $value['qty']);
									?>
										<div class="cart-card flex flex-column border-radius-medium p-3">
											<?php
												$sepatu_id = $value['sepatu_id'];
	
												$stmt = $conn -> prepare("SELECT * FROM sepatu WHERE id_sepatu = $sepatu_id");
												$stmt -> execute();
												$sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
	
												if(strlen($sepatu[0]['nama_sepatu']) > 25) {
													$nama_sepatu = substr($sepatu[0]['nama_sepatu'], 0, 25);
												} else {
													$nama_sepatu = $sepatu[0]['nama_sepatu'];
												}
	
												$item1_details = array(
													'id' => $sepatu_id,
													'price' => $value['price'],
													'quantity' => $value['qty'],
													'name' => $nama_sepatu
												);
												array_push($item_details, $item1_details);
											?>
											<div class="flex-center flex-vstart w-100">
												<img src='../../admin/<?= $sepatu[0]['link_gambarsepatu'] ?>' alt="" class="cart-img border-radius-medium" width="80px" height="80px">
												<div class="cart-info flex-center flex-vstart flex-column w-100">
													<div class="payment-text flex flex-vcenter" style="font-weight: 600;">
														<?= $sepatu[0]['nama_sepatu'] ?>
													</div>
													<div class="payment-text flex flex-vcenter">
														Rp.&nbsp;<span style="color: #ff4e5b;"><?= number_format($value['price'], 0, ',', '.') ?>
													</div>
												</div>
											</div>
											<div class="flex-center flex-hend flex-wrap-reverse" style="padding-top: 36px;">
												<div class="cart-control flex-center">
													<div class="margin-right left">
														<a href="../../<?= "detail_shoes.php?id_sepatu=" . $value['sepatu_id'] ?>">
															<button class="btn btn-dark">Details</button>
														</a>
													</div>
													<form action="" method="POST" class="margin-right right">
														<input type="hidden" name="id_cart" value="<?= $value['id_cart'] ?>">
														<button class="btn btn-danger" name="delete">Delete</button>
													</form>
												</div>
												<div class="cart-control-bottom flex-center">
													<div class="child-container subtotal flex-center">
														<span class="flex-center" style="font-weight: 600; margin: 0 8px;">
															Subtotal: Rp.&nbsp;<span style="color: #ff4e5b;"><?= number_format(($value['price'] * $value['qty']), 0, ',', '.') ?></span>
														</span>
													</div>
													<div class="child-container flex-center">
														<button class="qty btn btn-secondary" onclick="kurang(<?= $value['id_cart'] ?>, <?= $id_user ?>)">-</button>
														<input type="text" name="totqty" id="totqty" class="cart-textbox" value="<?= $value['qty'] ?>" readonly>
														<button class="qty btn btn-secondary" onclick="tambah(<?= $value['id_cart'] ?>, <?= $id_user ?>)">+</button>
													</div>
												</div>
											</div>
										</div>
									<?php
								}
							}
						?>
					</div>
					<div id="payment-box" class="flex">
						<div class="payment-inner border-radius-medium">
							<div class="payment-text flex-center flex-between pb-3">
								<span>Total Harga:</span>
								<span><?= "Rp. " . number_format($amount, 0, ',', '.') ?></span>
							</div>
							<div class="w-100">
								<form style="margin: 0;" method="POST">
									<input type="hidden" id="user" name="user" value='<?= json_encode($u) ?>'>
									<input type="hidden" id="cart_item" name="cart_item" value='<?= json_encode($item_details) ?>'>
									<input type="hidden" id="amount" name="amount" value='<?= $amount ?>'>
									<button class="btn btn-success w-100" id="pay-button" name="payment">Pay</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<form id="payment-form" method="post" action="./snap/finish" style="display: none;">
			<!-- <form id="payment-form" method="post" action="<?= site_url() ?>/transaction"> -->
			<!-- <form id="payment-form" method="post" action="./transaction"> -->
				<input type="hidden" name="result_type" id="result-type" value="">
				<input type="hidden" id="userid" name="userid" value='<?= $u['id_user'] ?>'>
				<input type="hidden" name="result_data" id="result-data" value=""></div>
			</form>
		</div>
		<div class="copyright w-100">
			<div class="copyright-padding fullwidth flex" style="flex-wrap: wrap;">
				<div class="col-sm-6 d-flex flex-column align-items-start p-0" style="text-align: left;">
					<div class="info-text font-bold">
						<div class="flex flex-vcenter">
							<span style="margin-right: 5px;">FOLLOW US ON</span>
							<a href="#" target="_blank"><img src="../../images/GitHub_Logo_White.png" alt="" class="flex flex-vcenter" style="width: 65px;"></a>
						</div>
						<br>
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
			<div class="copyright-padding fullwidth">2021 &copy; All Rights Reserved | <a href="../../">Adudu Shoes</a></div>
		</div>
		<script src="../../js/jquery-3.6.0.min.js"></script>
		<script src="../../js/popper.min.js"></script>
		<script src="../../js/bootstrap.bundle.min.js"></script>
		<script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
		<script>
			$(document).ready(function() {
				$("#search_icon").click(function(e) {
					e.preventDefault();

					window.location = "../../shoes.php?input-search=true";
				});

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
						$("#checkout-container").html("");
						$("#checkout-container").append(response);
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
						$("#checkout-container").html("");
						$("#checkout-container").append(response);
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

						// console.log(resultType);
						// console.log(resultData);
						// console.log(userid);

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
