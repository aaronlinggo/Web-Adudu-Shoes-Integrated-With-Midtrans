<?php
session_start();
require_once("./controller/connection.php");
$stmt = $conn->prepare("SELECT * FROM sepatu");
$stmt->execute();
$sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
	<meta http-equiv="X-UA-Compatible" charset="UTF-8" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<title>Catalog | Adudu Shoes</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">
	<!-- <link rel="icon" href="images/fevicon.png" type="image/gif"/> -->
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>

<body class="main-layout">
	<div class="header_section">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="logo">
						<a href="#">
							<img src="./images/logo.png">
						</a>
					</div>
				</div>
				<div class="col-sm-9">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
							<div class="navbar-nav">
								<a class="nav-item nav-link" href="./index.php">Home</a>
								<a class="nav-item nav-link" href="./collection.php">Collection</a>
								<a class="nav-item nav-link" href="./shoes.php">Shoes</a>
								<a class="nav-item nav-link last" href="#">
									<img src="./images/search_icon_black.png">
								</a>
								<a class="nav-item nav-link last" href="./cart.php">
									<img src="./images/shop_icon_black.png">
								</a>
								<a class="nav-item nav-link" href="#">
									<img src="./images/user_24px_black.png">
								</a>
								<a class="nav-item nav-link" href="./login.php">Sign In</a>
								<a class="nav-item nav-link" href="./register.php">Sign Up</a>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="collection_text">Shoes</div>
	<div class="layout_padding gallery_section">
		<div class="container">
			<?php
			$indexDecrement = count($sepatu) - 1;

			while ($indexDecrement > 0) {
			?>
				<div class="row">
					<?php
					for ($i = 0; $i < 3; $i++) {
						$lokasi = './admin/' . $sepatu[$indexDecrement]['link_gambarsepatu'];
					?>
						<div class="col-sm-12 col-md-6 col-lg-4" style="margin: 15px 0;">
							<div class="best_shoes flex-center flex-column flex-hend flex-between">
								<div>
									<p class="best_text"><?= $sepatu[$indexDecrement]['nama_sepatu'] ?></p>
								</div>
								<div>
									<div class="shoes_icon"><img src='<?= $lokasi ?>'></div>
									<div class="star_text flex-center flex-vend">
										<div class="right_part">
											<div class="shoes_price">Rp. <span style="color: #ff4e5b;"><?= $sepatu[$indexDecrement]['harga_sepatu'] ?></span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
						$indexDecrement -= 1;
					}
					?>
				</div>
			<?php
			}
			?>
			<div class="buy_now_bt">
				<button class="buy_text">Buy Now</button>
			</div>
		</div>
	</div>
	<div class="copyright">2021 All Rights Reserved | <a href="./">Adudu Shoes</a></div>
	<script src="./js/jquery.min.js"></script>
	<script src="./js/popper.min.js"></script>
	<script src="./js/bootstrap.bundle.min.js"></script>
	<script src="./js/jquery-3.0.0.min.js"></script>
	<script src="./js/plugin.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/custom.js"></script>
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

			//scroll slides on swipe for touch enabled devices
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