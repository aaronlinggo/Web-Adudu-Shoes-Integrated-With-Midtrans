<?php
session_start();
require_once("./controller/connection.php");

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if (isset($_GET['id_sepatu'])){
    $idx = $_GET['id_sepatu'];
    $stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu=$idx");
    $stmt->execute();
    $sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
}
else{
    header('Location: shoes.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Detail Shoes</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

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
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <?php $lokasi = "./admin/" . $sepatu[0]['link_gambarsepatu']; ?>
                    <div style="overflow: hidden; height: 25vw;">
                        <img src="<?= $lokasi ?>" class="img-fluid" alt="..." style="width: 100vw; margin-bottom: -10vw; margin-top: -20vw;">
                    </div>
                    <div class="detail_shoes">
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
                        <button class="btn btn-dark" style="width: 100%;">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("./section/footer_section.php") ?>
    <?php require_once("./section/script_section.php") ?>
</body>

</html>