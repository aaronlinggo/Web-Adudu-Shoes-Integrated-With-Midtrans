<?php
	require_once("./controller/connection.php");

    $pages = 1;
    $limit = 18;

    if(isset($_POST['page'])) {
        $pages = $_POST['page'];
    }

    $limit_start = ($pages - 1) * $limit;

    if(isset($_POST['query'])) {
        // $query = "'%".strtolower($_POST['query'])."%'";
        $temp = $_POST['query'];
        $query = "'%".$temp."%'";

        $stmt = $conn -> prepare("SELECT * FROM sepatu WHERE nama_sepatu LIKE '%".$temp."%' ORDER BY 1 DESC");
        // $stmt -> bind_param("s", $temp);
    } else {
        $stmt = $conn -> prepare("SELECT * FROM sepatu ORDER BY 1 DESC LIMIT ?, ?");
        $stmt -> bind_param("ii", $limit_start, $limit);
    }

	$stmt -> execute();
	$sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);

    // var_dump(count($sepatu));

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
                        <div class="shoes_icon"><img src='<?= $lokasi ?>'></div>
                        <div class="star_text flex-center flex-vend">
                            <div class="button_part">
                                <form action="" method="post">
                                    <input type="hidden" name="id_sepatu" value='<?= $value['id_sepatu'] ?>'>
                                    <button class="btn btn-success" style="border-radius: 4px;" name="details">Details</button>
                                </form>
                            </div>
                            <div class="right_part">
                                <div class="shoes_price">Rp. <span style="color: #ff4e5b;"><?= number_format($value['harga_sepatu'], 0, ',', '.') . ",-" ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
?>

<nav class="mb-5">
    <ul class="pagination justify-content-end">
    <?php
        if(isset($_POST['query'])) {
            $query = $conn -> prepare("SELECT COUNT(*) AS COUNTER FROM sepatu");
            $query -> execute();
            $results = $query -> get_result() -> fetch_assoc();
            $total_records = $results['COUNTER'];
        } else {
            $total_records = count($sepatu);
            $limit = (count($sepatu) > 18) ? 18 : count($sepatu);
        }

        // var_dump($total_records);

        $total_pages = ceil($total_records / $limit);
        $number_count = 1;
        $start_number = ($pages > $number_count) ? $pages - $number_count : 1;
        $end_number = ($pages < ($total_pages - $number_count)) ? $pages + $number_count : $total_pages;

        if($pages == 1) {
            echo '<li class="page-item disabled"><div class="page-link">First</div></li>';
            echo '<li class="page-item disabled"><div class="page-link"><span aria-hidden="true">&laquo;</span></div></li>';
            // echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            // echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $link_prev = ($pages > 1) ? $pages - 1 : 1;
            echo '<li class="page-item halaman" id="1"><div class="page-link">First</div></li>';
            echo '<li class="page-item halaman" id="'.$link_prev.'"><div class="page-link"><span aria-hidden="true">&laquo;</span></div></li>';
            // echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            // echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for($i = $start_number; $i <= $end_number; $i++){
            $link_active = ($pages == $i) ? ' active' : '';
            echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><div class="page-link">'.$i.'</div></li>';
            // echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }
 
        if($pages == $total_pages){
            echo '<li class="page-item disabled"><div class="page-link"><span aria-hidden="true">&raquo;</span></div></li>';
            echo '<li class="page-item disabled"><div class="page-link">Last</div></li>';
            // echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            // echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        } else {
            $link_next = ($pages < $total_pages) ? $pages + 1 : $total_pages;
            echo '<li class="page-item halaman" id="'.$link_next.'"><div class="page-link"><span aria-hidden="true">&raquo;</span></div></li>';
            echo '<li class="page-item halaman" id="'.$total_pages.'"><div class="page-link">Last</div></li>';
            // echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            // echo '<li class="page-item halaman" id="'.$total_pages.'"><a class="page-link" href="#">Last</a></li>';
        }
    ?>
    </ul>
</nav>
