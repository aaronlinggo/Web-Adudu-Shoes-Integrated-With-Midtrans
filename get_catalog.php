<?php
    session_start();
	require_once("./controller/connection.php");

    $pages = (isset($_POST['page'])) ? $_POST['page'] : 1;
    $limit = 18;
    $limit_start = ($pages - 1) * $limit;
    $isPopular = false;

    if(isset($_POST['sort']) && $_POST['sort'] != "") {
        if($_POST['sort'] == "popular") {
            $isPopular = true;
        } else if($_POST['sort'] == "newest") {
            $sort = "id_sepatu ASC";
        } else if($_POST['sort'] == "oldest") {
            $sort = "id_sepatu DESC";
        }
        // else if($_POST['sort'] == "price_asc") {
        //     $sort = "id_sepatu DESC";
        // } else if($_POST['sort'] == "price_desc") {
        //     $sort = "id_sepatu DESC";
        // }
    } else {
        $isPopular = true;
    }

    if(isset($_POST['search']) && filter_var($_POST['search'], FILTER_VALIDATE_BOOLEAN) == true) {
        $cmd = '%' . mysqli_real_escape_string($conn, $query) . '%';

        if($isPopular) {
            $sql = $conn -> prepare("SELECT s.*, SUM(o.qty) FROM sepatu s LEFT JOIN order_items o ON s.id_sepatu = o.sepatu_id WHERE nama_sepatu LIKE '%" . $cmd . "%' GROUP BY s.id_sepatu ORDER BY SUM(o.qty) DESC, s.id_sepatu ASC LIMIT ?, ?");
        } else {
            $sql = $conn -> prepare("SELECT * FROM sepatu WHERE nama_sepatu LIKE '%" . $cmd . "%' ORDER BY " . $sort . " LIMIT ?, ?");
        }

        $sql -> bind_param("ii", $limit_start, $limit);
        $sql -> execute();
        $sepatu = $sql -> get_result() -> fetch_all(MYSQLI_ASSOC);

        $sql = $conn -> prepare("SELECT COUNT(*) AS total FROM sepatu WHERE nama_sepatu LIKE '%" . $cmd . "%'");
        $sql -> execute();
        $get_total = $sql -> get_result() -> fetch_assoc();
    } else {
        if($isPopular) {
            $sql = $conn -> prepare("SELECT s.*, SUM(o.qty) FROM sepatu s LEFT JOIN order_items o ON s.id_sepatu = o.sepatu_id GROUP BY s.id_sepatu ORDER BY SUM(o.qty) DESC, s.id_sepatu ASC LIMIT ?, ?");
        } else {
            $sql = $conn -> prepare("SELECT * FROM sepatu ORDER BY " . $sort . " LIMIT ?, ?");
        }

        $sql -> bind_param("ii", $limit_start, $limit);
        $sql -> execute();
        $sepatu = $sql -> get_result() -> fetch_all(MYSQLI_ASSOC);

        $sql = $conn -> prepare("SELECT COUNT(*) AS total FROM sepatu");
        $sql -> execute();
        $get_total = $sql -> get_result() -> fetch_assoc();
    }

    foreach($sepatu as $key => $value) {
        $lokasi = "./admin/" . $value['link_gambarsepatu'];
        ?>
            <div class="flex catalog-card col-sm-12 col-md-6 col-lg-4">
                <div class="inner flex-center flex-column flex-hend flex-between">
                    <div>
                        <p class="catalog-item"><?= $value['nama_sepatu'] ?></p>
                    </div>
                    <div>
                        <div class="catalog-img-placeholder w-100">
                            <img class="catalog-img" src='<?= $lokasi ?>' alt="">
                        </div>
                        <div class="w-100 flex-center flex-column flex-vend">
                            <div class="align-items-center w-100">
                                <div class="flex-center flex-hstart w-100" style="font-size: 16px;"><?= ($value['stock_sepatu'] > 0) ? "Stock Available" : "Out of Stock" ?></div>
                                <div class="catalog-price flex-center flex-hstart w-100">Rp.&nbsp;<span style="color: #ff4e5b;"><?= number_format($value['harga_sepatu'], 0, ',', '.') ?></span></div>
                            </div>
                            <div class="catalog-btn-container align-items-center w-100 flex-center">
                                <a href='<?= "./detail_shoes.php?id_sepatu=" . $value['id_sepatu'] ?>' class="btn btn-dark border-radius-small catalog-btn" style="margin-right: 5px;">Details</a>
                                <?php
                                    if(isset($_SESSION['active'])) {
                                    ?>
                                        <button class="btn btn-dark border-radius-small catalog-btn empty-margin" name="addCart" id="addCart" value='<?= $value['id_sepatu'] ?>' onclick="addCart(this, 1)" style="margin-left: 5px;">Add to Cart</button>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="./login.php" class="btn btn-dark border-radius-small catalog-btn empty-margin" style="margin-left: 5px;">Add to Cart</a>
                                    <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
?>

<nav class="w-100 col-sm-12">
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
                    $total_numb = 3;
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
