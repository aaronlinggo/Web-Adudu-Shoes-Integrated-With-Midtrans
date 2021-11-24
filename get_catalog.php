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
        } else if($_POST['sort'] == "price-asc") {
            $sort = "harga_sepatu ASC, id_sepatu ASC";
        } else if($_POST['sort'] == "price-desc") {
            $sort = "harga_sepatu DESC, id_sepatu ASC";
        }
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

    if(count($sepatu) > 0) {
        foreach($sepatu as $key => $value) {
            $lokasi = "./admin/" . $value['link_gambarsepatu'];
            ?>
                <div class="flex catalog-card col-sm-12 col-md-6 col-lg-4">
                    <div class="inner flex-center flex-column flex-hend flex-between border-radius-medium">
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
    } else {
    ?>
        <div class="w-100 flex-center col-sm-12 py-5" style="font-size: 18pt; text-align: center;">Sorry we didn't find anything.</div>
    <?php
    }
?>

<nav class="w-100 col-sm-12 catalog-nav-page flex-center">
    <?php
        $count = $get_total['total'];

        if($count > 18) {
        ?>
            <ul class="pagination justify-content-end">
                <?php
                    if($pages == 1) {
                    ?>
                        <li class="btn page-item move-forward-small disabled w-100 h-100 flex-center" style="display: none; letter-spacing: -0.1rem;">&#10094;&#10094;</li>
                        <li class="btn page-item move-forward disabled w-100 h-100 flex-center">First</li>
                        <li class="btn page-item disabled w-100 h-100 flex-center">&#10094;</li>
                    <?php
                    } else {
                        $link_prev = ($pages > 1) ? $pages - 1 : 1;
                        ?>
                            <li class="btn page-item move-forward-small" style="display: none; letter-spacing: -0.1rem;"><a href="javascript:void(0);" class="w-100 h-100 flex-center" onclick="loadCatalog(1, false)">&#10094;&#10094;</a></li>
                            <li class="btn page-item move-forward"><a href="javascript:void(0);" class="w-100 h-100 flex-center" onclick="loadCatalog(1, false)">First</a></li>
                            <li class="btn page-item"><a href="javascript:void(0);" class="w-100 h-100 flex-center" onclick="loadCatalog(<?= $link_prev ?>, false)">&#10094;</a></li>
                        <?php
                    }

                    $total_pages = ceil($get_total['total'] / $limit);
                    $total_numb = 0;
                    $start_numb = ($pages > $total_numb) ? $pages - $total_numb : 1;
                    $end_numb = ($pages < ($total_pages - $total_numb)) ? $pages + $total_numb : $total_pages;

                    for($i = $start_numb; $i <= $end_numb; $i++) {
                        $link_active = ($pages == $i) ? 'class="btn page-item active"' : 'class="btn page-item"';
                        ?>
                            <li <?= $link_active ?>><a href="javascript:void(0);" class="w-100 h-100 flex-center" onclick="loadCatalog(<?= $i ?>, false)"><?= $i ?></a></li>
                        <?php
                    }

                    if($pages == $total_pages) {
                    ?>
                        <li class="btn page-item disabled w-100 h-100 flex-center">&#10095;</li>
                        <li class="btn page-item move-forward disabled w-100 h-100 flex-center">Last</li>
                        <li class="btn page-item move-forward-small disabled w-100 h-100 flex-center" style="display: none; letter-spacing: -0.1rem;">&#10095;&#10095;</li>
                    <?php
                    } else {
                        $link_next = ($pages < $total_pages) ? $pages + 1 : $total_pages;
                        ?>
                            <li class="btn page-item"><a href="javascript:void(0);" class="w-100 h-100 flex-center" onclick="loadCatalog(<?= $link_next ?>, false)">&#10095;</a></li>
                            <li class="btn page-item move-forward"><a href="javascript:void(0);" class="w-100 h-100 flex-center" onclick="loadCatalog(<?= $total_pages ?>, false)">Last</a></li>
                            <li class="btn page-item move-forward-small" style="display: none; letter-spacing: -0.1rem;"><a href="javascript:void(0);" class="w-100 h-100 flex-center" onclick="loadCatalog(<?= $total_pages ?>, false)">&#10095;&#10095;</a></li>
                        <?php
                    }
                ?>
            </ul>
        <?php
        }
    ?>
</nav>
