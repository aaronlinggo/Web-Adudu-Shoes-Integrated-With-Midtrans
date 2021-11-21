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
    <body id="body" class="main-layout">
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
                <!-- <div id="mboh" style="width: 40%; padding: 40px; max-height: 100%;"> -->
                <div id="mboh" style="width: 40%; padding: 40px; max-height: 100%; overflow-y: auto;">
                    <h1 style="font-style: italic;"><?= $sepatu[0]['nama_sepatu'] ?></h1>
                    <h1>Price: Rp. <span style="color: #ff4e5b;"><?= number_format($sepatu[0]['harga_sepatu'], 0, ',', '.') ?></span></h1>
                    <h1>Size: UK <span><?= number_format($sepatu[0]['size_sepatu'], 0, ',', '.') ?></span></h1>
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
                    <h1><?= $sepatu[0]['sub_desc'] ?></h1>
                    <div class="desc" style="overflow-y: auto;">
                        <p><?= $sepatu[0]['desc_sepatu'] . "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat, odit quasi! Non minus incidunt impedit. Ipsa incidunt, quo reprehenderit accusamus ipsam commodi assumenda odio, aliquam ratione esse, suscipit repudiandae perspiciatis eaque officiis voluptatibus numquam. Commodi necessitatibus doloremque illo odio omnis totam accusamus voluptatibus quod esse fugit numquam, labore voluptatum facilis, cupiditate excepturi ea nostrum. Quo natus ratione ipsam ad reiciendis minus doloremque, alias, officiis rerum nobis consequuntur perferendis, eius incidunt tempora inventore illum iste nulla nesciunt error pariatur. Unde rem doloremque, delectus neque nulla distinctio odit sequi sit quia quam earum. Iusto fugiat itaque porro modi ab suscipit vel nostrum." ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("./section/footer_section.php") ?>
		<script type="text/javascript" src="./js/add_cart.js"></script>
    </body>
</html>
