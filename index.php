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
	<title>Adudu Shoes</title>
	<?php require_once("./section/connection_head.php") ?>
	<link rel="stylesheet" href="./css/multi_item.css">
</head>

<body class="main-layout">
	<div class="header-section" style="position: relative;">
		<?php require_once("./section/nav_section.php") ?>
		<div class="banner_section">
			<div class="container-fluid">
				<div class="container-fluid">
					<div class="carousel-inner flex flex-wrap">
						<div class="col-sm-1 fullwidth"></div>
						<div class="col-sm-6">
							<div class="banner_taital">
								<h1 class="banner_text">New Shoes Model</h1>
								<h1 class="mens_text">
									<?php
									$stmt = $conn->prepare("SELECT * FROM sepatu ORDER BY id_sepatu ASC LIMIT 1");
									$stmt->execute();
									$lastShoes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
									?>
									<strong><?= $lastShoes[0]['nama_sepatu'] ?></strong>
								</h1>
								<?php
								$subdesc = $lastShoes[0]['sub_desc'];
								?>
								<p class="lorem_text"><?= $subdesc ?></p>
								<a href="./detail_shoes.php?id_sepatu=<?= $lastShoes[0]['id_sepatu'] ?>"><button class="buy_bt">Buy Now</button></a>
								<a href="./shoes.php"><button class="more_bt">See More</button></a>
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
	<div class="layout-padding collection_section">
		<div class="container">
			<!-- <h1 class="new_text">
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
				</div> -->
		</div>
	</div>
	<div class="collection_section">
		<div class="container">
			<h1 class="new_text">
				<strong>Recommended Shoes</strong>
				<?php
				$randomIndex = rand(0, count($sepatu) - 1);
				?>
			</h1>
			<p class="consectetur_text text-center" style="margin-right: 0; margin-left: 0;"><?= $sepatu[$randomIndex]['sub_desc'] ?></p>
		</div>
	</div>
	<div class="collectipn_section_3 layout-padding">
		<div class="container">
			<div class="racing_shoes">
				<div class="row">
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
							<strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong>
						</div>
						<!-- <button class="seemore">Buy Now</button> -->
						<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="seemore">Buy Now</button></a>
					</div>
					<?php
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
		$randomIndex = rand(11, count($sepatu) - 12);
	?>
	<div class="collectipn_section_3 layout-padding">
		<section class="pt-5 pb-5">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h3 class="mb-3 new_text"><strong>FEATURED PRODUCTS</strong></h3>
					</div>
					<div class="col-12">
						<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="row">
									<div class="carousel-item active">
										<div class="row">
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
										</div>
									</div>
									<div class="carousel-item">
										<div class="row">
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
										</div>
									</div>
									<div class="carousel-item">
										<div class="row">
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="card">
													<img class="img-fluid" alt="100%x280" src="<?= "./admin/" . $sepatu[$randomIndex]['link_gambarsepatu'] ?>">
													<div class="card-body">
														<h4 class="card-title"><?= $sepatu[$randomIndex]['nama_sepatu'] ?></h4>
														<p class="card-text" style="color: #ed2540;"><strong>Rp. <span style="color: #0a0506"><?= number_format($sepatu[$randomIndex]['harga_sepatu'], 0, ',', '.') ?></span></strong></p>
														<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="btn btn-dark border-radius-small catalog-btn empty-margin w-100" name="addCart" id="addCart" style="margin-left: 5px;">Buy Now</button></a>
													</div>
													<?php $randomIndex++ ?>
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
		</section>
	</div>
	<?php require_once("./section/footer_section.php") ?>
	<?php require_once("./section/script_section.php") ?>
	
</body>

</html>