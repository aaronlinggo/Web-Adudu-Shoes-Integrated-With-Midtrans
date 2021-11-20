<?php
    session_start();
    require_once("./controller/connection.php");

    $stmt = $conn -> prepare("SELECT * FROM users");
    $stmt -> execute();
    $users = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

    if(isset($_GET['id_sepatu'])) {
        $id_sepatu = $_GET['id_sepatu'];
        $stmt = $conn -> prepare("SELECT * FROM sepatu WHERE id_sepatu = $id_sepatu");
        $stmt -> execute();
        $sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
    } else {
        header('Location: shoes.php');
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title><?= $sepatu[0]['nama_sepatu'] ?> | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
        <?php require_once("./section/script_section.php") ?>
    </head>
    <body class="main-layout">
        <div class="header-section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="layout-padding contact_section" style="padding-top: 20px;">
			<div class="position-sticky p-3" style="top: 0; right: 0; z-index: 11;">
				<div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header">
						<strong style="margin-right: auto;">Success</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">
						Your item has been added to cart.
					</div>
				</div>
			</div>
            <div class="container-fluid ram">
                <div><a href="shoes.php"><button class="btn btn-dark" style="width: 10vw;">Back</button></a></div>
                <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-12" style="border-right: 1px solid black;">
                        <?php $lokasi = "./admin/" . $sepatu[0]['link_gambarsepatu']; ?>
                        <!-- sub_desc dibagian atas
                                desc_sepatu dibawah
                        -->
                        <div style="overflow: hidden; height: 50vw;">
                            <img src="<?= $lokasi ?>" class="img-fluid" alt="" style="width: 100vw; margin-bottom: -15vw; margin-top: -15vw;">
                            <!-- Hover -->
                            <!-- <div class="container-fluid">
                                    <h1><?= $sepatu[0]['sub_desc'] ?></h1>
                                    <div class="desc">
                                        <p><?= $sepatu[0]['desc_sepatu'] ?></p>
                                    </div>
                                </div> -->
                        </div>
                        <div class="container-fluid">
                            <h1><?= $sepatu[0]['sub_desc'] ?></h1>
                            <div class="desc">
                                <p><?= $sepatu[0]['desc_sepatu'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div style="border: 3px solid black; padding: 10px 10px; width: 100%; color: black; text-align: left; font-weight: bold; font-size: 32px;"><i><?= $sepatu[0]['nama_sepatu'] ?><i></div>
                        <div class="shoes_price">Price Rp. <span style="color: #ff4e5b;"><?= number_format($sepatu[0]['harga_sepatu'], 0, ',', '.') . ",-" ?></span></div>
                        <div class="shoes_price">Size UK <span><?= number_format($sepatu[0]['size_sepatu'], 0, ',', '.') ?></span></div>
                        <div>
                            <?php
                                if(isset($_SESSION['active'])) {
                                ?>
                                    <button class="btn btn-dark" style="border-radius: 4px; width: 100%;" name="addCart" id="addCart" value='<?= $id_sepatu ?>' onclick="addCart(this)">Add to Cart</button>
                                <?php
                                } else {
                                ?>
                                    <a href="./login.php" class="btn btn-dark" style="border-radius: 4px; width: 100%;">Add to Cart</a>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("./section/footer_section.php") ?>
		<script type="text/javascript" src="./js/add_cart.js"></script>
    </body>
</html>
