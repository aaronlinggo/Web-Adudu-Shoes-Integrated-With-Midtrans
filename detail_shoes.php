<?php
session_start();
require_once("./controller/connection.php");

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if (isset($_GET['id_sepatu'])) {
    $id_sepatu = $_GET['id_sepatu'];
    $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu=$id_sepatu");
    $stmt->execute();
    $sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    header('Location: shoes.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addCart'])){
        $id_user = $_SESSION['active'];
        $active = true;
        $qty = 1;
        $price = $sepatu[0]['harga_sepatu'];

        $stmt = $conn->prepare("SELECT * FROM cart_item WHERE user_id=$id_user AND active = 1");
        $stmt->execute();
        $checking = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $ada = false;
        foreach($checking as $key => $value){
            if ($value['sepatu_id'] == $id_sepatu){
                $ada = true;
            }
        }

        if (!$ada){
            $stmt = $conn->prepare("INSERT INTO cart_item(user_id, sepatu_id, qty, price, active) VALUES(?,?,?,?,?)");
            $stmt->bind_param("iiiii", $id_user, $id_sepatu, $qty, $price, $active);
            $result = $stmt->execute();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <!-- DYNAMIC NAME -->
        <title>Detail | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
    </head>
    <body class="main-layout">
        <div class="header_section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="layout_padding contact_section" style="padding-top: 20px;">
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
                            if (isset($_SESSION['active'])) {
                                echo "<form action='' method='post'>";
                            }
                            ?>
                            
                                <input type="hidden" name="id_sepatu" value="<?= $id_sepatu ?>">
                                <a href='<?php
                                            if (!isset($_SESSION['active'])) {
                                                echo "login.php";
                                            }
                                            ?>'>
                                    <button class="btn btn-dark" style="width: 100%;" <?php
                                                                                        if (isset($_SESSION['active'])) {
                                                                                            echo "name='addCart'";
                                                                                        }
                                                                                        ?>>Add to Cart</button>
                                </a>
                            <?php
                            if (isset($_SESSION['active'])) {
                                echo "</form>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("./section/footer_section.php") ?>
        <?php require_once("./section/script_section.php") ?>
    </body>
</html>