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
        header('Location: ./shoes.php');
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title><?= $sepatu[0]['nama_sepatu'] ?> | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
        <?php require_once("./section/script_section.php") ?>
    </head>
    <body class="main-layout" id="detail-page">
        <div style="height: 100vh; display: flex; flex-flow: column;">
            <div class="header-section">
                <?php require_once("./section/nav_section.php") ?>
            </div>
			<div id="notifPopup" class="position-sticky" style="display: none;">
				<div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header">
						<strong style="margin-right: auto;">Success</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">Your item has been added to cart.</div>
				</div>
			</div>
            <div style="width: 100%; height: 1px; background-color: lightgray;"></div>
            <div class="container detail flex flex-wrap" style="overflow: hidden;">
                <?php
                    $lokasi = "url('./admin/" . $sepatu[0]['link_gambarsepatu'] . "');";
                ?>
                <div id="detail-left" class="img-container h-100 flex-center flex-vend">
                    <div class="detail-back">
                        <a href="./shoes.php" style="margin-right: 4px;">
                            <button class="btn btn-dark">Back</button>
                        </a>
                    </div>
                    <div class="detail-img w-100" style="<?= "background-image: " . $lokasi ?>"></div>
                </div>
                <div id="detail-right" class="flex-center flex-column">
                    <div class="w-100">
                        <h1 class="detail-title w-100"><?= $sepatu[0]['nama_sepatu'] ?></h1>
                        <div class="w-100" style="font-size: 18px; min-height: 200px;">
                            <div class="flex flex-between py-2">
                                <h4 class="detail-sec-row flex-center" style="font-size: 24px!important;">
                                    Rp.&nbsp;<span style="color: #ff4e5b;"><?= number_format($sepatu[0]['harga_sepatu'], 0, ',', '.') ?></span>
                                </h4>
                            </div>
                            <div class="flex flex-between pt-3">
                                <h4 class="detail-sec-row flex-center">
                                    Available in Size <?= number_format($sepatu[0]['size_sepatu'], 0, ',', '.') ?> (UK)
                                </h4>
                            </div>
                            <div class="py-2" style="text-align: left;">
                                <?php
                                    $stmt = $conn -> prepare("SELECT SUM(qty) AS total FROM order_items WHERE sepatu_id = ?");
                                    $stmt -> bind_param("i", $sepatu[0]['id_sepatu']);
                                    $stmt -> execute();
                                    $count = $stmt -> get_result() -> fetch_assoc();
                                ?>
                                <?= $count['total'] ?> of this item has been sold.<?php
                                    if($sepatu[0]['stock_sepatu'] <= 0) {
                                    ?>
                                        <span>And now we're out of stock. Please check again later!</span>
                                    <?php
                                    } else if($sepatu[0]['stock_sepatu'] <= 5) {
                                    ?>
                                        <span>The stock is very low. Grab yours now before it's sold out!</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span>The stock is still available. Come grab yours now!</span>
                                    <?php
                                    }
                                ?>
                            </div>
                            <div class="flex flex-vcenter flex-between pb-3">
                                <div class="flex">
                                    Stock : <?= $sepatu[0]['stock_sepatu'] ?>
                                    <input type="hidden" name="" id="jumlahstock" value="<?= $sepatu[0]['stock_sepatu'] ?>">
                                </div>
                                <div class="flex flex-vcenter">
                                    <span>Qty:&nbsp;&nbsp;</span>
                                    <div class="flex flex-vcenter">
                                        <button class="qty btn btn-secondary" onclick="kurang()">-</button>
                                        <input type="text" name="jumlahqty" id="jumlahqty" class="cart-textbox" value="1" readonly>
                                        <button class="qty btn btn-secondary" onclick="tambah()">+</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if(isset($_SESSION['active'])) {
                                ?>
                                    <button class="w-100 btn btn-dark border-radius-small py-2 my-2" name="addCart" id="addCart" value='<?= $id_sepatu ?>' onclick="addCart(this, 1)">Add to Cart</button>
                                <?php
                                } else {
                                ?>
                                    <a href="./login.php" class="btn btn-dark border-radius-small py-2 my-2" style="width: 100%;">Add to Cart</a>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 100%; height: 1px; background-color: lightgray;"></div>
        <div class="container detail-bottom">
            <div id="detail-right-clone" class="flex-center flex-column" style="margin-bottom: 40px;">
                <div class="w-100">
                    <h1 class="detail-title w-100"><?= $sepatu[0]['nama_sepatu'] ?></h1>
                    <div class="w-100" style="font-size: 18px; min-height: 200px;">
                        <div class="flex flex-between py-2">
                            <h4 class="detail-sec-row flex-center detail-price" style="font-size: 24px!important;">
                                Rp.&nbsp;<span style="color: #ff4e5b;"><?= number_format($sepatu[0]['harga_sepatu'], 0, ',', '.') ?></span>
                            </h4>
                        </div>
                        <div class="flex flex-between pt-4">
                            <h4 class="detail-sec-row flex-center">
                                Available in Size <?= number_format($sepatu[0]['size_sepatu'], 0, ',', '.') ?> (UK)
                            </h4>
                        </div>
                        <div class="py-3" style="text-align: left;">
                            <?php
                                $stmt = $conn -> prepare("SELECT SUM(qty) AS total FROM order_items WHERE sepatu_id = ?");
                                $stmt -> bind_param("i", $sepatu[0]['id_sepatu']);
                                $stmt -> execute();
                                $count = $stmt -> get_result() -> fetch_assoc();
                            ?>
                            <?= ($count['total'] <= 0) ? "0" : $count['total'] ?> of this item has been sold.<?php
                                if($sepatu[0]['stock_sepatu'] <= 0) {
                                ?>
                                    <span>And now we're out of stock. Please check again later!</span>
                                <?php
                                } else if($sepatu[0]['stock_sepatu'] <= 5) {
                                ?>
                                    <span>The stock is very low. Grab yours now before it's sold out!</span>
                                <?php
                                } else {
                                ?>
                                    <span>The stock is still available. Come grab yours now!</span>
                                <?php
                                }
                            ?>
                        </div>
                        <div class="flex flex-vcenter flex-wrap flex-between" style="padding-bottom: 20px;">
                            <div class="flex" style="padding-bottom: 8px;">
                                Stock : <?= $sepatu[0]['stock_sepatu'] ?>
                                <input type="hidden" name="" id="jumlahstock" value="<?= $sepatu[0]['stock_sepatu'] ?>">
                            </div>
                            <div class="flex flex-vcenter" style="padding-bottom: 8px;">
                                <span>Qty:&nbsp;&nbsp;</span>
                                <div class="flex flex-vcenter">
                                    <button class="qty btn btn-secondary" onclick="kurang()">-</button>
                                    <input type="text" name="jumlahqty" id="jumlahqty" class="cart-textbox" value="1" readonly>
                                    <button class="qty btn btn-secondary" onclick="tambah()">+</button>
                                </div>
                            </div>
                        </div>
                        <?php
                            if(isset($_SESSION['active'])) {
                            ?>
                                <button class="w-100 btn btn-dark border-radius-small py-2 my-2" name="addCart" id="addCart" value='<?= $id_sepatu ?>' onclick="addCart(this, 1)">Add to Cart</button>
                            <?php
                            } else {
                            ?>
                                <a href="./login.php" class="btn btn-dark border-radius-small py-2 my-2" style="width: 100%;">Add to Cart</a>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <h1 class="detail-sub"><?= $sepatu[0]['sub_desc'] ?></h1>
            <div class="desc">
                <p style="margin: 0; text-align: left;"><?= $sepatu[0]['desc_sepatu'] ?></p>
            </div>
        </div>
        <?php require_once("./section/footer_section.php") ?>
		<script type="text/javascript" src="./js/add_cart.js"></script>
        <script>
			function tambah() {
				document.getElementById("jumlahqty").value++;
				document.getElementById("addCart").setAttribute("onclick", "addCart(this, " + document.getElementById("jumlahqty").value +")");
                
                if (document.getElementById("jumlahstock").value - document.getElementById("jumlahqty").value <= 0){
                    document.getElementById("jumlahqty").value = document.getElementById("jumlahstock").value;
                }
                if (document.getElementById("jumlahqty").value >= 9){
                    document.getElementById("jumlahqty").value = 9;
                    document.getElementById("addCart").setAttribute("onclick", "addCart(this, " + document.getElementById("jumlahqty").value +")");
                }
			}

			function kurang() {
				document.getElementById("jumlahqty").value--;
                document.getElementById("addCart").setAttribute("onclick", "addCart(this, " + document.getElementById("jumlahqty").value +")");

                if (document.getElementById("jumlahqty").value <= 1){
                    document.getElementById("jumlahqty").value = 1;
                    document.getElementById("addCart").setAttribute("onclick", "addCart(this, " + document.getElementById("jumlahqty").value +")");
                }
			}
		</script>
    </body>
</html>
