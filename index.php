<?php
	session_start();
	require_once("./controller/connection.php");

	$stmt = $conn -> prepare("SELECT * FROM SEPATU");
	$stmt -> execute();
	$sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Adudu Shoes</title>
		<?php require_once("./section/connection_head.php") ?>
	</head>
	<body class="main-layout">
		<div class="header_section">
			<?php require_once("./section/nav_section.php") ?>
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
													$lokasi = "./admin/" . $lastShoes[0]['link_gambarsepatu'];
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
								<img src='<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>' style="max-width: 70%;">
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
		<?php require_once("./section/footer_section.php") ?>
		<?php require_once("./section/script_section.php") ?>
	</body>
</html>
