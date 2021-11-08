<?php
session_start();
require_once("./controller/connection.php");
$stmt = $conn->prepare("SELECT * FROM sepatu ORDER BY 1 DESC");
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

	<?php require_once("./section/connection_head.php") ?>
</head>

<body class="main-layout">
	<div class="header_section">
		<?php require_once("./section/nav_section.php") ?>
	</div>
	<div class="collection_text">Shoes</div>
	<div class="layout_padding gallery_section">
		<div class="container">
			<div class="row">
				<?php
				foreach ($sepatu as $key => $value) {
					$lokasi = "./admin/" . $value['link_gambarsepatu'];
				?>
					<div class="col-sm-12 col-md-6 col-lg-4" style="margin: 15px 0;">
						<div class="best_shoes flex-center flex-column flex-hend flex-between">
							<div>
								<p class="best_text"><?= $value['nama_sepatu'] ?></p>
							</div>
							<div>
								<div class="shoes_icon"><img src='<?= $lokasi ?>'></div>
								<div class="star_text flex-center flex-vend">
									<button class="btn-success" style="border-radius: 4px;">Add to Chart</button>
									<div class="right_part">
										<div class="shoes_price">Rp. <span style="color: #ff4e5b;"><?= number_format($value['harga_sepatu'], 0, ',', '.') . ",-" ?></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>
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