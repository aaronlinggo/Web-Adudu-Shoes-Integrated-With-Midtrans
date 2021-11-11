<?php
	session_start();
	require_once("./controller/connection.php");

	$stmt = $conn -> prepare("SELECT * FROM sepatu");
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
													<h1 class="banner_text">New Shoes Model </h1>
													<h1 class="mens_text">
														<?php
															$stmt = $conn -> prepare("SELECT * FROM sepatu ORDER BY id_sepatu DESC LIMIT 1");
															$stmt -> execute();
															$lastShoes = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
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
			</div>
		</div>
		<div class="collection_section">
			<div class="container">
				<h1 class="new_text">
					<strong>Recommended Shoes</strong>
				</h1>
				<p class="consectetur_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit natus suscipit velit hic? Sit, aliquid nihil natus ipsa, quae at sapiente veritatis quasi neque non veniam dolor omnis, ducimus accusantium?</p>
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
				<strong>Empty Section #1</strong>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque quas saepe qui labore, molestias suscipit sed aliquam nam reiciendis velit fuga explicabo pariatur ducimus iste quam, odit quasi quo nostrum, inventore culpa sunt voluptate deleniti omnis tempore. Fugiat repudiandae sapiente temporibus est, natus magni alias iste totam quisquam corporis nihil, enim, iusto officiis ipsum voluptatum nobis accusantium a quos assumenda non. Alias hic dolores eius cupiditate voluptatem culpa amet inventore aliquam neque molestias id fugiat tempore debitis quam magnam, asperiores, doloremque deleniti ipsum assumenda maiores quo laboriosam optio! Cupiditate vel harum facilis sed nesciunt quas necessitatibus eaque veniam molestiae reprehenderit!
			</div>
		</div>
		<div class="layout_padding gallery_section">
			<div class="container">
				<strong>Empty Section #2</strong>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque quas saepe qui labore, molestias suscipit sed aliquam nam reiciendis velit fuga explicabo pariatur ducimus iste quam, odit quasi quo nostrum, inventore culpa sunt voluptate deleniti omnis tempore. Fugiat repudiandae sapiente temporibus est, natus magni alias iste totam quisquam corporis nihil, enim, iusto officiis ipsum voluptatum nobis accusantium a quos assumenda non. Alias hic dolores eius cupiditate voluptatem culpa amet inventore aliquam neque molestias id fugiat tempore debitis quam magnam, asperiores, doloremque deleniti ipsum assumenda maiores quo laboriosam optio! Cupiditate vel harum facilis sed nesciunt quas necessitatibus eaque veniam molestiae reprehenderit!
			</div>
		</div>
		<?php require_once("./section/footer_section.php") ?>
		<?php require_once("./section/script_section.php") ?>
	</body>
</html>
