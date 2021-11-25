<?php
	session_start();
	require_once("./controller/connection.php");

	$stmt = $conn->prepare("SELECT * FROM sepatu");
	$stmt->execute();
	$sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	if (isset($_SESSION['active'])){
        $id_user = $_SESSION['active'];
        $stmt = $conn->prepare("SELECT * FROM notification_handler WHERE id_user = $id_user and active = 1 ORDER BY ID DESC");
        $stmt->execute();
        $notification_handler = $stmt->get_result()->fetch_assoc() ?? [];
    }
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Adudu Shoes</title>
		<?php require_once("./section/connection_head.php") ?>
		<link rel="stylesheet" href="./css/multi_item.css">
	</head>
	<body class="main-layout">
		<div id="header" class="header-section" style="position: relative;">
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
		<?php
		if (isset($notification_handler)){
            if (count($notification_handler)>0){
                ?>
                <div id="notifPopup" class="position-sticky" style="display: none;">
                    <div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong style="margin-right: auto;">Payment Notification</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">Your #<?= $notification_handler['order_id'] ?> transaction is <?php if ($notification_handler['status'] == 'expire') { echo "not"; } ?> complete.</div>
                    </div>
                </div>
                <script>
                    let notifTimer;
                    let calcHeaderHeight = $("#header").height() + 30;

                    $(document).ready(function() {
                        $(".btn-close").click(function(e) {
                            e.preventDefault();
                            clearTimeout(notifTimer);

                            $("#liveToast").removeClass("show");
                            $("#liveToast").addClass("hide");

                            setTimeout(() => {
                                $("#notifPopup").removeAttr("style");
                                $("#notifPopup").css({ "display": "none" });
                            }, 250);
                        });
                    });
                    $("#notifPopup").removeAttr("style");
                    $("#notifPopup").css({
                        "display": "block",
                        "top": calcHeaderHeight,
                        "right": "0",
                        "z-index": "99999"
                    });

                    clearTimeout(notifTimer);

                    setTimeout(() => {
                        $("#liveToast").removeClass("hide");
                        $("#liveToast").addClass("show");
                    }, 250);

                    notifTimer = setTimeout(() => {
                        $("#liveToast").removeClass("show");
                        $("#liveToast").addClass("hide");

                        setTimeout(() => {
                            $("#notifPopup").removeAttr("style");
                            $("#notifPopup").css({ "display": "none" });
                        }, 250);
                    }, 5000);
                </script>
                <?php
                $id_notif = $notification_handler['id'];
                $temp_active = 0;
                $result = $conn -> query("update notification_handler set active = $temp_active where id = $id_notif");
            }
		}
        ?>
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
							<a href="./detail_shoes.php?id_sepatu=<?= $sepatu[$randomIndex]['id_sepatu'] ?>"><button class="seemore">Buy Now</button></a>
						</div>
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
											<div class="row d-flex flex-wrap">
												<div class="col-lg-3 col-md-6 mb-3">
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
												<div class="col-lg-3 col-md-6 mb-3">
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
												<div class="col-lg-3 col-md-6 mb-3">
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
												<div class="col-lg-3 col-md-6 mb-3">
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
											<div class="row d-flex flex-wrap">
												<div class="col-lg-3 col-md-6 mb-3">
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
												<div class="col-lg-3 col-md-6 mb-3">
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
												<div class="col-lg-3 col-md-6 mb-3">
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
												<div class="col-lg-3 col-md-6 mb-3">
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
											<div class="row d-flex flex-wrap">
												<div class="col-lg-3 col-md-6 mb-3">
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
												<div class="col-lg-3 col-md-6 mb-3">
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
												<div class="col-lg-3 col-md-6 mb-3">
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
												<div class="col-lg-3 col-md-6 mb-3">
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
