<?php
	session_start();
	require_once("./controller/connection.php");

	$stmt = $conn -> prepare("SELECT * FROM sepatu ORDER BY 1 DESC");
	$stmt -> execute();
	$sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['details'])) {
			$id_sepatu = $_POST['id_sepatu'];
			// echo "<script>window.location = './detail_shoes.php?id_sepatu=$id_sepatu';</script>";
			header("Location: detail_shoes.php?id_sepatu=$id_sepatu");
		}
	}
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Catalog | Adudu Shoes</title>
		<?php require_once("./section/connection_head.php") ?>
		<?php require_once("./section/script_section.php") ?>
	</head>
	<body class="main-layout">
		<div class="header_section">
			<?php require_once("./section/nav_section.php") ?>
		</div>
		<div class="collection_text">Shoes</div>
		<div class="layout_padding gallery_section">
			<div class="container">
				<div id="catalog_row" class="row"></div>
				<div class="buy_now_bt">
					<button class="buy_text">Buy Now</button>
				</div>
			</div>
		</div>
		<?php require_once("./section/footer_section.php") ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$.ajax({
					"cache": false
				});

				$.ajaxPrefilter(function(options, originalOptions, jqXHR) {
					options.async = true;
				});

				$("#search_img").click(function(e) {
					e.preventDefault();
					e.stopPropagation();

					// BELUM MULUS
					$("#search_area").slideToggle();
				});

				$("#search_btn").click(function(e) {
					e.preventDefault();
					e.stopPropagation();

					// BELUM MULUS
					$("#search_area").hide();
				});
				// $("#search_btn").click(function(e) {
				// 	e.preventDefault();

				// 	// REGEX OR QUERY GOES HERE THEN CALL THE AJAX
				// });
			});
		</script>
		<script type="text/javascript" src="./js/ajax.js"></script>
	</body>
</html>
