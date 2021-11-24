<?php
	session_start();
	require_once("./controller/connection.php");

	$stmt = $conn -> prepare("SELECT * FROM sepatu ORDER BY 1 DESC");
	$stmt -> execute();
	$sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

	if(isset($_POST['search_btn'])) {
		$keyword = $_POST['search_bar'];

		if($keyword != "") {
			echo "<script>window.location = './shoes.php?keyword=$keyword';</script>";
		} else {
			echo "<script>window.location = './shoes.php';</script>";
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
		<div class="header-section">
			<?php require_once("./section/nav_section.php") ?>
		</div>
		<div id="catalog" class="fullwidth h-auto flex flex-column" style="position: relative;">
			<div class="position-sticky p-3" style="top: 0; right: 0; z-index: 99999;">
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
					<div class="query-box w-100 col-sm-12 flex-center flex-wrap flex-between border-radius-medium">
						<div class="inner col-lg-8 col-sm-12 flex flex-hstart flex-vcenter" style="padding: 0;">
							<div class="h-100 flex-center flex-hstart" style="font-size: 12pt;">
								<div class="filter-label align-middle" style="color: #000;">Sort By</div>
								<?php
									if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == "popular") {
									?>
										<div id="popular" class="filter-button btn btn-success border-radius-small align-middle" style="background-color: rgba(0, 0, 0, 0.15); color: #000;">Popular</div>
									<?php
									} else {
									?>
										<div id="popular" class="filter-button btn btn-dark border-radius-small align-middle">Popular</div>
									<?php
									}
								?>
								<?php
									if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == "newest") {
									?>
										<div id="newest" class="filter-button btn btn-success border-radius-small align-middle" style="background-color: rgba(0, 0, 0, 0.15); color: #000;">Newest</div>
									<?php
									} else {
									?>
										<div id="newest" class="filter-button btn btn-dark border-radius-small align-middle">Newest</div>
									<?php
									}
								?>
								<?php
									if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == "oldest") {
									?>
										<div id="oldest" class="filter-button btn btn-success border-radius-small align-middle" style="background-color: rgba(0, 0, 0, 0.15); color: #000;">Oldest</div>
									<?php
									} else {
									?>
										<div id="oldest" class="filter-button btn btn-dark border-radius-small align-middle">Oldest</div>
									<?php
									}
								?>
								<div class="flex-center h-100">
									<select name="price" id="price" class="h-100">
										<option disabled selected hidden>Price</option>
										<option value="price-desc">High -> Low</option>
										<option value="price-asc">Low -> High</option>
									</select>
								</div>
							</div>
						</div>
						<div class="inner col-lg-4 col-sm-12 flex flex-hend flex-vcenter" style="padding: 0;">
							<form action="" method="POST" autocomplete="off" class="flex-center flex-hend">
								<!-- <div id="search_area" class="flex w-100"> -->
									<input type="text" name="search_bar" id="search_bar" required>
									<button name="search_btn" id="search_btn" style="margin-left: 10px;">Search</button>
								<!-- </div> -->
							</form>
						</div>
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

				// $("#search_img").click(function(e) {
				// 	e.preventDefault();
				// 	e.stopPropagation();
				// });

				if(<?= json_encode((isset($_REQUEST['keyword'])) ? $_REQUEST['keyword'] : "") ?> != "") {
					loadCatalog(1, true);
				} else {
					loadCatalog(1, false);
				}

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

			function loadCatalog(page, search) {
				let query = <?= json_encode((isset($_REQUEST['keyword'])) ? $_REQUEST['keyword'] : "") ?>;
				let sort = <?= json_encode((isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : "") ?>;

				$.ajax({
					method: "POST",
					url: "./get_search.php",
					data: {
						page: page,
						query: query,
						search: search,
						sort: sort
					},
					dataType: "json",
					beforeSend: function(e) {
						if(e && e.overrideMimeType) {
							e.overrideMimeType("application/json;charset=UTF-8");
						}
					},
					success: function(response) {
						$("#catalog_row").html(response.hasil);
					}
				});
			}

			function callOnSort(sortBy) {
				let keyword = <?= json_encode((isset($_REQUEST['keyword'])) ? $_REQUEST['keyword'] : "") ?>;

				if(keyword != "") {
					append = "./shoes.php?keyword=" + keyword + "&sort=" + sortBy;
				} else {
					append = "./shoes.php?sort=" + sortBy;
				}

				window.location = append;
			}

			$("#popular").click(function(e) { 
				e.preventDefault();
				callOnSort("popular");
			});

			$("#newest").click(function(e) { 
				e.preventDefault();
				callOnSort("newest");
			});

			$("#oldest").click(function(e) { 
				e.preventDefault();
				callOnSort("oldest");
			});

			$("#price").on("change", function() {
				callOnSort(this.value);
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
		<!-- <script type="text/javascript" src="./js/get_catalog.js"></script> -->
		<script type="text/javascript" src="./js/add_cart.js"></script>
	</body>
</html>
