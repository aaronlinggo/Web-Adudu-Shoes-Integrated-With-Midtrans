<?php
	session_start();
	require_once("./controller/connection.php");

	$stmt = $conn -> prepare("SELECT * FROM sepatu ORDER BY 1 DESC");
	$stmt -> execute();
	$sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Shoes | Adudu Shoes</title>
		<?php require_once("./section/connection_head.php") ?>
		<?php require_once("./section/script_section.php") ?>
	</head>
	<body class="main-layout">
		<div class="header-section">
			<?php require_once("./section/nav_section.php") ?>
		</div>
		<div id="catalog" class="fullwidth h-auto flex flex-column" style="position: relative;">
			<div class="position-sticky p-3" style="top: 0; right: 0; z-index: 11;">
				<div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header">
						<strong style="margin-right: auto;">Success</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">Your item has been added to cart.</div>
				</div>
			</div>
			<!-- <div class="collection_text">Shoes</div> -->
			<div class="layout-padding gallery_section">
				<div class="container landing-padding about">
					<div id="search_area" style="position: absolute; top: 80px; left: 30px; display: block;" class="flex">
						<input type="text" name="search_bar" id="search_bar">
						<button name="search_btn" id="search_btn" style="margin-left: 10px;">Search</button>
					</div>
					<div id="catalog_row" class="row"></div>
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
					// $("#search_area").hide();
				});

				// $("#search_btn").click(function(e) {
				// 	e.preventDefault();

				// 	// REGEX OR QUERY GOES HERE THEN CALL THE AJAX (OPTIONAL)
				// });

				// var win = $(window);
				// function lazyload() {
				// 	$(function() {
				// 		$(".lazy").Lazy({
				// 			scrollDirection: "vertical",
				// 			effect: "fadeIn",
				// 			visibleOnly: true,
				// 			onError: function(element) {
				// 				console.log("Error when loading " + element.data("src"));
				// 			}
				// 		});
				// 	});
				// }
				// win.on('resize scroll', lazyload);
				// lazyload();
			});

			// $(function() {
			// 	$(".lazy").Lazy({
			// 		scrollDirection: "vertical",
			// 		effect: "fadeIn",
			// 		effectTime: "fast",
			// 		threshold: 0,
			// 		visibleOnly: true,
			// 		onError: function(element) {
			// 			console.log("Error when loading " + element.data("src"));
			// 		}
			// 	});
			// });
			// $(window).on("load", function() {
			// });
		</script>
		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.plugins.min.js"></script> -->
		<script type="text/javascript" src="./js/get_catalog.js"></script>
		<script type="text/javascript" src="./js/add_cart.js"></script>
	</body>
</html>
