<?php
    session_start();
	require_once("./controller/connection.php");

    $pages = (isset($_POST['page'])) ? $_POST['page'] : 1;
    $limit = 18;
    $limit_start = ($pages - 1) * $limit;

    if(isset($_POST['search']) && $_POST['search'] == true) {
        $cmd = '%' . mysqli_real_escape_string($conn, $query) . '%';

        $sql = $conn -> prepare("SELECT * FROM sepatu WHERE nama_sepatu LIKE '%" . $cmd . "%' ORDER BY 1 DESC LIMIT ?, ?");
        $sql -> bind_param("ii", $limit_start, $limit);
        $sql -> execute();
        $sepatu = $sql -> get_result() -> fetch_all(MYSQLI_ASSOC);

        $sql = $conn -> prepare("SELECT COUNT(*) AS total FROM sepatu WHERE nama_sepatu LIKE '%" . $cmd . "%'");
        $sql -> execute();
        $get_total = $sql -> get_result() -> fetch_assoc();
    } else {
        $sql = $conn -> prepare("SELECT * FROM sepatu ORDER BY 1 DESC LIMIT ?, ?");
        $sql -> bind_param("ii", $limit_start, $limit);
        $sql -> execute();
        $sepatu = $sql -> get_result() -> fetch_all(MYSQLI_ASSOC);

        $sql = $conn -> prepare("SELECT COUNT(*) AS total FROM sepatu");
        $sql -> execute();
        $get_total = $sql -> get_result() -> fetch_assoc();
    }

    // NEED TO IMPLEMENT LAZY IMAGE OR USE SPINNER
    foreach($sepatu as $key => $value) {
        $lokasi = "./admin/" . $value['link_gambarsepatu'];
        ?>
            <div class="col-sm-12 col-md-6 col-lg-4" style="margin: 15px 0;">
                <div class="best_shoes flex-center flex-column flex-hend flex-between">
                    <div>
                        <p class="best_text"><?= $value['nama_sepatu'] ?></p>
                    </div>
                    <div>
                        <div class="shoes_icon">
                            <img src='<?= $lokasi ?>' alt="">
                        </div>
                        <div class="star_text flex-center flex-vend">
                            <div class="button_part">
                                <form action="" method="POST">
                                    <input type="hidden" name="id_sepatu" id="id_sepatu" value='<?= $value['id_sepatu'] ?>'>
                                    <button class="btn btn-success" style="border-radius: 4px;" name="details" id="details">Details</button>
                                </form>
                                <?php
                                    if(isset($_SESSION['active'])) {
                                    ?>
                                        <button class="btn btn-success" style="border-radius: 4px;" name="addCart" id="addCart" value='<?= $value['id_sepatu'] ?>' onclick="addCart(this, 1)">Add to Cart</button>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="./login.php" class="btn btn-success" style="border-radius: 4px;">Add to Cart</a>
                                    <?php
                                    }
                                ?>
                            </div>
                            <div class="right_part" style="text-align: right;">
                                <div><?= ($value['stock_sepatu'] > 0) ? "Stock Available" : "Out of Stock" ?></div>
                                <div class="shoes_price">Rp. <span style="color: #ff4e5b;"><?= number_format($value['harga_sepatu'], 0, ',', '.') ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
?>

<nav class="mb-5">
    <?php
        $count = $get_total['total'];

        if($count > 18) {
        ?>
            <ul class="pagination justify-content-end">
                <?php
                    if($pages == 1) {
                    ?>
                        <!-- <li class="page-item disabled"><a href="#">First</a></li>
                        <li class="page-item disabled"><a href="#">&laquo;</a></li> -->
                    <?php
                    } else {
                        $link_prev = ($pages > 1) ? $pages - 1 : 1;
                        ?>
                            <li class="page-item"><a href="javascript:void(0);" onclick="loadCatalog(1, false)">First</a></li>
                            <li class="page-item"><a href="javascript:void(0);" onclick="loadCatalog(<?= $link_prev ?>, false)">&laquo;</a></li>
                        <?php
                    }

                    $total_pages = ceil($get_total['total'] / $limit);
                    $total_numb = 3; // Set how many link number before and after active page
                    $start_numb = ($pages > $total_numb) ? $pages - $total_numb : 1;
                    $end_numb = ($pages < ($total_pages - $total_numb)) ? $pages + $total_numb : $total_pages;

                    for($i = $start_numb; $i <= $end_numb; $i++) {
                        $link_active = ($pages == $i) ? 'class="page-item active"' : '';
                        ?>
                            <li <?= $link_active ?>><a href="javascript:void(0);" onclick="loadCatalog(<?= $i ?>, false)"><?= $i ?></a></li>
                        <?php
                    }

                    if($pages == $total_pages) {
                    ?>
                        <!-- <li class="page-item disabled"><a href="#">&raquo;</a></li>
                        <li class="page-item disabled"><a href="#">Last</a></li> -->
                    <?php
                    } else {
                        $link_next = ($pages < $total_pages) ? $pages + 1 : $total_pages;
                        ?>
                            <li class="page-item"><a href="javascript:void(0);" onclick="loadCatalog(<?= $link_next ?>, false)">&raquo;</a></li>
                            <li class="page-item"><a href="javascript:void(0);" onclick="loadCatalog(<?= $total_pages ?>, false)">Last</a></li>
                        <?php
                    }
                ?>
            </ul>
        <?php
        }
    ?>
</nav>
