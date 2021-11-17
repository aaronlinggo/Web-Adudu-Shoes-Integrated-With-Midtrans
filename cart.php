<?php
    session_start();
    require_once("./controller/connection.php");

    $id_user = $_SESSION['active'];
    $stmt = $conn -> prepare("SELECT * FROM cart_item WHERE user_id = $id_user and active = 1");
    $stmt -> execute();
    $cart_item = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['delete'])) {
            $id_cart = $_POST['id_cart'];
            $result = $conn -> query("DELETE FROM cart_item WHERE id_cart = $id_cart");
            header('Location: cart.php');
        }

        if(isset($_POST['payment'])) {
        }
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Cart | Adudu Shoes</title>
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<SB-Mid-client-3OxJRhBsnTXSca5E>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <?php require_once("./section/connection_head.php") ?>
    </head>
    <body class="main-layout">
        <div class="header_section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="collection_text">Cart</div>
        <div class="layout_padding contact_section">
            <div class="container-fluid ram">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Shoes Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total = 0;

                                    foreach($cart_item as $key => $value) {
                                        $total += ($value['price'] * $value['qty']);
                                        ?>
                                            <tr>
                                                <td><?= ($key + 1) ?></td>
                                                <td>
                                                <?php
                                                    $sepatu_id = $value['sepatu_id'];

                                                    $stmt = $conn -> prepare("SELECT * FROM sepatu WHERE id_sepatu = $sepatu_id");
                                                    $stmt -> execute();
                                                    $sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

                                                    echo $sepatu[0]['nama_sepatu'];
                                                ?>
                                                </td>
                                                <td><?= "Rp. " . number_format($value['price'], 0, ',', '.') . ",-" ?></td>
                                                <td><?= $value['qty'] ?></td>
                                                <td><?= "Rp. " . number_format(($value['price'] * $value['qty']), 0, ',', '.') . ",-" ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div style="margin-right: 1vh;">
                                                            <a href="../../<?= "detail_shoes.php?id_sepatu=" . $value['sepatu_id'] ?>">
                                                                <button class="btn btn-success">Details</button>
                                                            </a>
                                                        </div>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="id_cart" value="<?= $value['id_cart'] ?>">
                                                            <button class="btn btn-danger" name="delete">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                                <tr class="bg-secondary text-white">
                                    <td colspan="4">
                                        <div style="float: right;">
                                            Subtotal :
                                        </div>
                                    </td>
                                    <td>
                                        <?= "Rp. " . number_format($total, 0, ',', '.') . ",-" ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <form action="" method="post" style="float: right;">
                                            <button class="btn btn-success" name="payment">Payment</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">2021 All Rights Reserved | <a href="./">Adudu Shoes</a></div>
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.bundle.min.js"></script>
        <script src="../../js/jquery-3.0.0.min.js"></script>
        <script src="../../js/plugin.js"></script>
        <script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="../../js/custom.js"></script>
        <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".fancybox").fancybox({
                    openEffect: "none",
                    closeEffect: "none"
                });

                $('#myCarousel').carousel({
                    interval: false
                });

                // Scroll slides on android swipes
                $("#myCarousel").on("touchstart", function(event) {
                    var yClick = event.originalEvent.touches[0].pageY;

                    $(this).one("touchmove", function(event) {
                        var yMove = event.originalEvent.touches[0].pageY;

                        if(Math.floor(yClick - yMove) > 1) {
                            $(".carousel").carousel('next');
                        } else if(Math.floor(yClick - yMove) < -1) {
                            $(".carousel").carousel('prev');
                        }
                    });

                    $(".carousel").on("touchend", function() {
                        $(this).off("touchmove");
                    });
                });
            });
        </script>
    </body>
</html>
