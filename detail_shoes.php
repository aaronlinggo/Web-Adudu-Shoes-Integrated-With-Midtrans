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
        <div style="height: 100vh; display: flex; flex-flow: column;">
            <div class="header-section">
                <?php require_once("./section/nav_section.php") ?>
            </div>
            <div style="width: 100%; height: 1px; background-color: lightgray;"></div>
            <div class="detail flex" style="overflow: hidden;">
                <?php
                    $lokasi = "url('./admin/" . $sepatu[0]['link_gambarsepatu'] . "');";
                ?>
                <div class="img-container h-100 flex-center flex-vend">
                    <div class="detail-back">
                        <a href="./shoes.php" style="margin-right: 4px;">
                            <button class="btn btn-dark">Back</button>
                        </a>
                    </div>
                    <div class="detail-img w-100" style="<?= "background-image: " . $lokasi ?>"></div>
                </div>
                <div class="flex-center flex-column flex-between" style="width: 40%; padding: 40px; height: 100%; max-height: 100%;">
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
                    <h1 class="w-100" style="font-style: italic; line-height: 48px; font-size: 36px;"><?= $sepatu[0]['nama_sepatu'] ?></h1>
                    <div class="w-100">
                        <table>
                            <tbody>
                                <tr class="align-middle" style="font-size: 30px;">
                                    <!-- <td style="color: #0f0d10;">Price&nbsp;&nbsp;&nbsp;</td>
                                    <td style="color: #0f0d10;">:&nbsp;</td> -->
                                    <td style="color: #0f0d10;">Rp. <span style="color: #ff4e5b;"><?= number_format($sepatu[0]['harga_sepatu'], 0, ',', '.') ?></span></td>
                                </tr>
                                <tr class="align-middle" style="font-size: 30px;">
                                    <!-- <td style="color: #0f0d10;">Size&nbsp;&nbsp;&nbsp;</td>
                                    <td style="color: #0f0d10;">:&nbsp;</td> -->
                                    <td style="color: #0f0d10;">UK <?= number_format($sepatu[0]['size_sepatu'], 0, ',', '.') ?></td>
                                </tr>
                                <tr class="align-middle" style="font-size: 30px;">
                                    <!-- <td style="color: #0f0d10;">Stock&nbsp;&nbsp;&nbsp;</td>
                                    <td style="color: #0f0d10;">:&nbsp;</td> -->
                                    <td style="color: #0f0d10;">
                                        Stock Available : <?= $sepatu[0]['stock_sepatu'] ?>
                                        <input type="hidden" name="" id="jumlahstock" value="<?= $sepatu[0]['stock_sepatu'] ?>">
                                    </td>
                                </tr>
                                <tr class="align-middle" style="font-size: 30px;">
                                    <td class="d-flex justify-content-center">
                                        <span>Qty: </span>
                                        <!-- <button class="btn btn-secondary">-</button>
                                        <input type="text" name="" id="" class="form-control" style="width: 35px;" value="1">
                                        <button class="btn btn-secondary">+</button> -->
                                        <button class="btn btn-secondary" onclick="kurang()">-</button>
                                        <input type="text" name="jumlahqty" id="jumlahqty" class="form-control" style="width: 35px;" value="1">
                                        <button class="btn btn-secondary" onclick="tambah()">+</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-100">
                        <?php
                            if(isset($_SESSION['active'])) {
                            ?>
                                <button class="btn btn-dark w-100" name="addCart" id="addCart" value='<?= $id_sepatu ?>' onclick="addCart(this, 1)">Add to Cart</button>
                            <?php
                            } else {
                            ?>
                                <a href="./login.php" class="btn btn-dark border-radius-small" style="width: 100%;">Add to Cart</a>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 100%; height: 1px; background-color: lightgray;"></div>
        <div style="margin: 60px;">
            <h1 style="padding-bottom: 20px; text-align: left;"><?= $sepatu[0]['sub_desc'] ?></h1>
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
