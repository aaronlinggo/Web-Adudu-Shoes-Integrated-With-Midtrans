<?php
	session_start();
	require_once("./controller/connection.php");

	$stmt = $conn -> prepare("SELECT * FROM sepatu ORDER BY 1 ASC");
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
	<body class="main-layout flex flex-column">
		<div id="header" class="header-section segment">
			<?php require_once("./section/nav_section.php") ?>
		</div>
		<div id="catalog" class="fullwidth h-auto flex flex-column">
			<div id="notifPopup" class="position-sticky" style="display: none;">
				<div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header">
						<strong style="margin-right: auto;">Success</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">Your item has been added to cart.</div>
				</div>
			</div>
			<div class="container landing-padding about h-auto flex-center catalog-main">
				<h1 class="title about-section m-0 mt-4 mt-sm-5 p-0 pt-3 pt-sm-2 font-bold" style="text-align: center;">SHOES CATALOG</h1>
			</div>
			<div class="layout-padding about">
				<div class="container landing-padding about h-auto">
					<div class="query-box w-100 col-sm-12 flex-center flex-wrap-reverse flex-between border-radius-medium">
						<div class="inner col-lg-8 col-md-12 col-sm-12 flex flex-hstart flex-vcenter" style="overflow-x: auto; overflow-y: hidden; -ms-overflow-style: none; scrollbar-width: none;">
							<div class="inner-container col-md-12 h-100 flex-center flex-hstart">
								<div class="filter-label flex-center flex-hstart h-100" style="color: #000; min-width: 80px;">Sort By</div>
								<?php
									if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == "popular") {
									?>
										<div id="popular" class="col-md-2 filter-button filter-control active btn border-radius-small align-middle">Popular</div>
									<?php
									} else {
									?>
										<div id="popular" class="col-md-2 filter-button filter-control btn btn-dark border-radius-small align-middle">Popular</div>
									<?php
									}
								?>
								<?php
									if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == "newest") {
									?>
										<div id="newest" class="col-md-2 filter-button filter-control active btn border-radius-small align-middle">Newest</div>
									<?php
									} else {
									?>
										<div id="newest" class="col-md-2 filter-button filter-control btn btn-dark border-radius-small align-middle">Newest</div>
									<?php
									}
								?>
								<?php
									if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == "oldest") {
									?>
										<div id="oldest" class="col-md-2 filter-button filter-control active btn border-radius-small align-middle">Oldest</div>
									<?php
									} else {
									?>
										<div id="oldest" class="col-md-2 filter-button filter-control btn btn-dark border-radius-small align-middle">Oldest</div>
									<?php
									}
								?>
								<div class="flex-center h-100">
									<?php
										if(isset($_REQUEST['sort']) && ($_REQUEST['sort'] == "price-desc" || $_REQUEST['sort'] == "price-asc")) {
										?>
											<select name="price" id="price" class="filter-control active outer-btn border-radius-small align-middle btn">
										<?php
										} else {
										?>
											<select name="price" id="price" class="filter-control outer-btn border-radius-small align-middle btn btn-dark">
										<?php
										}
									?>
										<?php
											if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == "price-desc") {
											?>
												<option class="align-middle" disabled selected hidden>Price: High to Low</option>
											<?php
											} else if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == "price-asc") {
											?>
												<option class="align-middle" disabled selected hidden>Price: Low to High</option>
											<?php
											} else {
											?>
												<option class="align-middle" disabled selected hidden>Price</option>
											<?php
											}
										?>
										<option class="align-middle" style="text-align: left;" value="price-desc">Price: High to Low</option>
										<option class="align-middle" style="text-align: left;" value="price-asc">Price: Low to High</option>
									</select>
								</div>
							</div>
						</div>
						<div class="inner col-lg-4 col-md-12 col-sm-12 flex flex-hend flex-vcenter" style="padding: 0;">
							<form action="" method="POST" autocomplete="off" class="col-lg-11 col-md-12 p-0 flex-center flex-hend">
								<?php
									if(isset($_REQUEST['input-search']) && $_REQUEST['input-search'] == "true") {
									?>
										<input type="text" name="search_bar" id="search_bar" class="filter-control outer-textbox border-radius-small" placeholder="Search" autofocus required>
									<?php
									} else {
									?>
										<input type="text" name="search_bar" id="search_bar" class="filter-control outer-textbox border-radius-small" placeholder="Search" required>
									<?php
									}
								?>
								<button name="search_btn" id="search_btn" class="filter-button filter-control btn btn-dark border-radius-small flex-center" style="margin-right: 0;">
									<svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" width="20px" height="20px">
										<g>
											<path fill="#ffffff" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
										</g>
									</svg>
								</button>
								<button name="search_btn" id="search_btn_clone" class="filter-button filter-control btn btn-dark border-radius-small flex-center" style="display: none; margin-right: 0;">
									<svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" width="20px" height="20px">
										<g>
											<path fill="#ffffff" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
										</g>
									</svg>
								</button>
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

				if(<?= json_encode((isset($_REQUEST['keyword'])) ? $_REQUEST['keyword'] : "") ?> != "") {
					loadCatalog(1, true);
				} else {
					loadCatalog(1, false);
				}
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
		</script>
		<script type="text/javascript" src="./js/add_cart.js"></script>
	</body>
</html>
