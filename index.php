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
		<meta http-equiv="X-UA-Compatible" charset="utf-8" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<title>Adudu Shoes</title>
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- <link rel="icon" href="./images/favicon.png" type="image/gif"> -->
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/responsive.css">
		<link rel="stylesheet" href="./css/jquery.mCustomScrollbar.min.css">
		<link rel="stylesheet" href="./css/owl.carousel.min.css">
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
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
								<div class="navbar-nav" style="align-items: center;">
									<a class="nav-item nav-link" href="./index.php">Home</a>
									<a class="nav-item nav-link" href="./collection.php">Collection</a>
									<a class="nav-item nav-link" href="./shoes.php">Shoes</a>
									<a class="nav-item nav-link last" href="#">
										<img src="./images/search_icon_black.png">
									</a>
									<a class="nav-item nav-link last" href="./cart.php">
										<img src="./images/shop_icon_black.png">
									</a>
									<?php 
									if (!isset($_SESSION['active'])) { ?>
										<a class="btn btn-outline-danger" href="login.php" style="height: 100%;">Sign In</a>
										<a class="btn btn-outline-danger" href="register.php" style="height: 100%;">Sign Up</a>
									<?php }
									else{ ?>
										<a class="nav-item nav-link" href="#">
											<img src="./images/user_24px_black.png">
										</a>
										<a class="btn btn-outline-danger" href="logout.php" style="height: 100%;">Sign Out</a>
									<?php }
									?>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
			<div class="banner_section">
				<div class="container-fluid">
					<section class="slide-wrapper">
						<div class="container-fluid">
							<div id="myCarousel" class="carousel slide" data-ride="carousel">
								<div class="carousel-indicators">
									<div data-target="#myCarousel" data-slide-to="0" class="active"></div>
								</div>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<div class="row">
											<div class="col-sm-1 padding_0">
											</div>
											<div class="col-sm-6">
												<div class="banner_taital">
													<h1 class="banner_text">New Running Shoes </h1>
													<h1 class="mens_text">
														<?php 
															$stmt = $conn->prepare("SELECT * FROM sepatu ORDER BY id_sepatu DESC LIMIT 1");
															$stmt->execute();
															$lastShoes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
														?>
														<strong><?= $lastShoes[0]['nama_sepatu'] ?></strong>
													</h1>
													<?php 
														$subdesc = $lastShoes[0]['sub_desc'];
													?>
													<p class="lorem_text"><?= $subdesc ?></p>
													<button class="buy_bt">Buy Now</button>
													<button class="more_bt">See More</button>
												</div>
											</div>
											<div class="col-sm-5">
												<div class="shoes_img">
													<?php 
														$lokasi = "./admin/".$lastShoes[0]['link_gambarsepatu'];
													?>
													<img src="<?= $lokasi ?>" style="z-index: -1; width: ;">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
		<div class="layout_padding collection_section">
			<div class="container">
				<h1 class="new_text">
					<strong>New Collection</strong>
				</h1>
				<p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
				<div class="collection_section_2">
					<div class="row">
						<div class="col-md-6">
							<div class="about-img">
								<button class="new_bt">New</button>
								<div class="shoes-img">
									<img src="./images/shoes-img1.png">
								</div>
								<p class="sport_text">Men Sports</p>
								<div class="dolar_text">$ <strong style="color: #f12a47;">90</strong></div>
								<div class="star_icon">
									<ul>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
									</ul>
								</div>
							</div>
							<button class="seemore_bt">See More</button>
						</div>
						<div class="col-md-6">
							<div class="about-img2">
								<div class="shoes-img2">
									<img src="./images/shoes-img2.png">
								</div>
								<p class="sport_text">Men Sports</p>
								<div class="dolar_text">$ <strong style="color: #f12a47;">90</strong></div>
								<div class="star_icon">
									<ul>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="collection_section">
			<div class="container">
				<h1 class="new_text">
					<strong>Racing Boots</strong>
				</h1>
				<p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
			</div>
		</div>
		<div class="collectipn_section_3 layuot_padding">
			<div class="container">
				<div class="racing_shoes">
					<div class="row">
						<?php
							$randomIndex = rand(0, count($sepatu) - 1);
							?>
								<div class="col-md-7 flex-center">
									<div class="shoes-img3">
										<img src='<?= "./admin/".$sepatu[$randomIndex]['link_gambarsepatu'] ?>' style="max-width: 70%;">
									</div>
								</div>
								<div class="col-md-5 flex flex-hcenter flex-column">
									<div class="sale_text">
										<strong>Sale <br>
										<span style="color: #0a0506;"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></span></strong>
									</div>
									<div class="number_text">
										<strong>Rp. <span style="color: #0a0506"><?= $sepatu[$randomIndex]['harga_sepatu'] ?></span></strong>
									</div>
									<button class="seemore">See More</button>
								</div>
							<?php
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="collection_section layout_padding">
			<div class="container">
				<h1 class="new_text">
					<strong>New Arrivals Products</strong>
				</h1>
				<p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
			</div>
		</div>
		<div class="layout_padding gallery_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="best_shoes">
							<p class="best_text">Best Shoes </p>
							<div class="shoes_icon">
								<img src="./images/shoes-img4.png">
							</div>
							<div class="star_text">
								<div class="left_part">
									<ul>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
									</ul>
								</div>
								<div class="right_part">
									<div class="shoes_price">$ <span style="color: #ff4e5b;">60</span></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="best_shoes">
							<p class="best_text">Best Shoes </p>
							<div class="shoes_icon">
								<img src="./images/shoes-img5.png">
							</div>
							<div class="star_text">
								<div class="left_part">
									<ul>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
									</ul>
								</div>
								<div class="right_part">
									<div class="shoes_price">$ <span style="color: #ff4e5b;">400</span></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="best_shoes">
							<p class="best_text">Best Shoes </p>
							<div class="shoes_icon">
								<img src="./images/shoes-img6.png">
							</div>
							<div class="star_text">
								<div class="left_part">
									<ul>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
									</ul>
								</div>
								<div class="right_part">
									<div class="shoes_price">$ <span style="color: #ff4e5b;">50</span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="best_shoes">
							<p class="best_text">Sports Shoes</p>
							<div class="shoes_icon">
								<img src="./images/shoes-img7.png">
							</div>
							<div class="star_text">
								<div class="left_part">
									<ul>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
									</ul>
								</div>
								<div class="right_part">
									<div class="shoes_price">$ <span style="color: #ff4e5b;">70</span></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="best_shoes">
							<p class="best_text">Sports Shoes</p>
							<div class="shoes_icon">
								<img src="./images/shoes-img8.png">
							</div>
							<div class="star_text">
								<div class="left_part">
									<ul>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
									</ul>
								</div>
								<div class="right_part">
									<div class="shoes_price">$ <span style="color: #ff4e5b;">100</span></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="best_shoes">
							<p class="best_text">Sports Shoes</p>
							<div class="shoes_icon">
								<img src="./images/shoes-img9.png">
							</div>
							<div class="star_text">
								<div class="left_part">
									<ul>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
										<li><a href="#"><img src="./images/star-icon.png"></a></li>
									</ul>
								</div>
								<div class="right_part">
									<div class="shoes_price">$ <span style="color: #ff4e5b;">90</span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="buy_now_bt">
					<button class="buy_text">Buy Now</button>
				</div>
			</div>
		</div>
		<div class="layout_padding contact_section">
			<div class="container">
				<h1 class="new_text">
					<strong>Contact Now</strong>
				</h1>
			</div>
			<div class="container-fluid ram">
				<div class="row">
					<div class="col-md-6">
						<div class="email_box">
							<div class="input_main">
								<div class="container">
									<form action="./action_page.php">
										<div class="form-group">
											<input type="text" class="email-bt" placeholder="Name" name="Name">
										</div>
										<div class="form-group">
											<input type="text" class="email-bt" placeholder="Phone Numbar" name="Name">
										</div>
										<div class="form-group">
											<input type="text" class="email-bt" placeholder="Email" name="Email">
										</div>
										<div class="form-group">
											<textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
										</div>
									</form>
								</div>
								<div class="send_btn">
									<button class="main_bt">Send</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="shop_banner">
							<div class="our_shop">
								<button class="out_shop_bt">Our Shop</button>
							</div>
						</div>
					</div>
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
