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

		if(isset($_POST['addCart'])) {
            // $id_user = $_SESSION['active'];
            // $active = true;
            // $qty = 1;
            // $price = $sepatu[0]['harga_sepatu'];

            // $stmt = $conn -> prepare("SELECT * FROM cart_item WHERE user_id = $id_user AND active = 1");
            // $stmt -> execute();
            // $checking = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

            // $ada = false;

            // foreach($checking as $key => $value) {
            //     if($value['sepatu_id'] == $id_sepatu) {
            //         $ada = true;
            //     }
            // }

            // if(!$ada) {
            //     $stmt = $conn -> prepare("INSERT INTO cart_item(user_id, sepatu_id, qty, price, active) VALUES(?,?,?,?,?)");
            //     $stmt -> bind_param("iiiii", $id_user, $id_sepatu, $qty, $price, $active);
            //     $result = $stmt -> execute();
            // }
        }
	}
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Shoes | Adudu Shoes</title>
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
		<script type="text/javascript" src="./js/get_catalog.js"></script>
	</body>
</html>
