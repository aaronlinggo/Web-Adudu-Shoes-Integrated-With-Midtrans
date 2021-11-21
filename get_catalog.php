<?php
    session_start();
	require_once("./controller/connection.php");

    // Cek apakah terdapat data page pada URL
    $page = (isset($_POST['page'])) ? $_POST['page'] : 1;
    $limit = 18; // Jumlah data per halamannya
    $limit_start = ($page - 1) * $limit;
    $numb = $limit_start + 1; // Untuk setting awal nomor pada halaman yang aktif

    // Cek apakah variabel data search tersedia
    // Artinya cek apakah user telah mengklik tombol search atau belum
    if(isset($_POST['search']) && $_POST['search'] == true) { // Jika ada data search yg dikirim (user telah mengklik tombol search) dan search sama dengan true
        // variabel $keyword ini berasal dari file search.php,
        // dimana isinya adalah apa yang diinput oleh user pada textbox pencarian
        // $param = '%'.mysqli_real_escape_string($conn, $keyword).'%';
        $cmd = '%'.mysqli_real_escape_string($conn, $query).'%';
        // $cmd = $_REQUEST['query'];

        // Buat query untuk menampilkan data siswa berdasarkan NIS / Nama / Jenis Kelamin / Telp / Alamat
        // dan sesuai limit yang ditentukan
        // $sql = mysqli_query($conn, "SELECT * FROM sepatu WHERE nama_sepatu LIKE '%".$cmd."%' ORDER BY 1 DESC LIMIT ".$limit_start.", ".$limit);

        // Buat query untuk menghitung semua jumlah data
        // dengan keyword yang telah di input
        // $sql2 = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM sepatu WHERE nama_sepatu LIKE '%".$cmd."%'");
        // $get_jumlah = mysqli_fetch_array($sql2);

        $sql = $conn -> prepare("SELECT * FROM sepatu WHERE nama_sepatu LIKE '%".$cmd."%' ORDER BY 1 DESC LIMIT ?, ?");
        $sql -> bind_param("ii", $limit_start, $limit);
        $sql -> execute();
        $sepatu = $sql -> get_result() -> fetch_all(MYSQLI_ASSOC);

        $sql2 = $conn -> prepare("SELECT COUNT(*) AS jumlah FROM sepatu WHERE nama_sepatu LIKE '%".$cmd."%'");
        $sql2 -> execute();
        $get_jumlah = $sql2 -> get_result() -> fetch_assoc();
    } else { // Jika user belum mengklik tombol search (PROSES TANPA AJAX)
        // Buat query untuk menampilkan semua data siswa
        // $sql = mysqli_query($conn, "SELECT * FROM sepatu ORDER BY 1 DESC LIMIT ".$limit_start.", ".$limit);

        // Buat query untuk menghitung semua jumlah data
        // $sql2 = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM sepatu");
        // $get_jumlah = mysqli_fetch_array($sql2);

        $sql = $conn -> prepare("SELECT * FROM sepatu ORDER BY 1 DESC LIMIT ?, ?");
        $sql -> bind_param("ii", $limit_start, $limit);
        $sql -> execute();
        $sepatu = $sql -> get_result() -> fetch_all(MYSQLI_ASSOC);

        $sql2 = $conn -> prepare("SELECT COUNT(*) AS jumlah FROM sepatu");
        $sql2 -> execute();
        $get_jumlah = $sql2 -> get_result() -> fetch_assoc();
    }



    // $pages = 1;
    // $limit = 18;

    // if(isset($_REQUEST['page'])) {
    //     $pages = $_REQUEST['page'];
    // }

    // $limit_start = ($pages - 1) * $limit;

    // if(isset($_REQUEST['query'])) {
    //     $cmd = $_REQUEST['query'];
    //     $stmt = $conn -> prepare("SELECT * FROM sepatu WHERE nama_sepatu LIKE '%".$cmd."%' ORDER BY 1 DESC LIMIT ?, ?");
    //     $stmt -> bind_param("ii", $limit_start, $limit);
    // } else {
    //     $stmt = $conn -> prepare("SELECT * FROM sepatu ORDER BY 1 DESC LIMIT ?, ?");
    //     $stmt -> bind_param("ii", $limit_start, $limit);
    // }

	// $stmt -> execute();
	// $sepatu = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
    // var_dump(count($sepatu));

    // NEED TO IMPLEMENT LAZY IMAGE OR USE SPINNER
    // while($value = mysqli_fetch_array($sql)){
    foreach($sepatu as $key => $value) {
        $lokasi = "./admin/" . $value['link_gambarsepatu'];
        // var_dump($value);
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
                                <form action="" method="POST">
                                    <input type="hidden" name="id_sepatu" id="id_sepatu" value='<?= $value['id_sepatu'] ?>'>
                                    <button class="btn btn-success" style="border-radius: 4px;" name="details" id="details">Details</button>
                                </form>
                                <?php
                                    if(isset($_SESSION['active'])) {
                                    ?>
                                        <button class="btn btn-success" style="border-radius: 4px;" name="addCart" id="addCart" value='<?= $value['id_sepatu'] ?>' onclick="addCart(this)">Add to Cart</button>
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
        $count = $get_jumlah['jumlah'];

        if($count > 0) {
            var_dump($count);
        ?>
            <ul class="pagination justify-content-end">
                <?php
                    if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
                    ?>
                        <li class="page-item disabled"><a href="#">First</a></li>
                        <li class="page-item disabled"><a href="#">&laquo;</a></li>
                    <?php
                    }else{ // Jika page bukan page ke 1
                        $link_prev = ($page > 1)? $page - 1 : 1;
                    ?>
                        <li><a href="javascript:void(0);" onclick="loadCatalog(1, false)">First</a></li>
                        <li><a href="javascript:void(0);" onclick="loadCatalog(<?php echo $link_prev; ?>, false)">&laquo;</a></li>
                    <?php
                    }
                    ?>

                    <!-- LINK NUMBER -->
                    <?php
                    $jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
                    $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                    $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
                    $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

                    for($i = $start_number; $i <= $end_number; $i++){
                        $link_active = ($page == $i)? ' class="active"' : '';
                    ?>
                        <li<?php echo $link_active; ?>><a href="javascript:void(0);" onclick="loadCatalog(<?php echo $i; ?>, false)"><?php echo $i; ?></a></li>
                    <?php
                    }
                    ?>

                    <!-- LINK NEXT AND LAST -->
                    <?php
                    // Jika page sama dengan jumlah page, maka disable link NEXT nya
                    // Artinya page tersebut adalah page terakhir
                    if($page == $jumlah_page){ // Jika page terakhir
                    ?>
                        <li class="page-item disabled"><a href="#">&raquo;</a></li>
                        <li class="page-item disabled"><a href="#">Last</a></li>
                    <?php
                    }else{ // Jika Bukan page terakhir
                        $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                    ?>
                        <li class="page-item"><a href="javascript:void(0);" onclick="loadCatalog(<?php echo $link_next; ?>, false)">&raquo;</a></li>
                        <li class="page-item"><a href="javascript:void(0);" onclick="loadCatalog(<?php echo $jumlah_page; ?>, false)">Last</a></li>
                    <?php
                    }

                    // if(isset($_POST['query'])) {
                    //     $query = $conn -> prepare("SELECT COUNT(*) AS COUNTER FROM sepatu WHERE nama_sepatu LIKE '%".$cmd."%'");
                    // } else {
                    //     $query = $conn -> prepare("SELECT COUNT(*) AS COUNTER FROM sepatu");
                    // //     $total_records = count($sepatu);
                    // //     $limit = (count($sepatu) > 18) ? 18 : count($sepatu);
                    // }

                    // $query -> execute();
                    // $results = $query -> get_result() -> fetch_assoc();
                    // $total_records = $results['COUNTER'];

                    // // var_dump($total_records);

                    // $total_pages = ceil($total_records / $limit);
                    // $number_count = 1;
                    // $start_number = ($pages > $number_count) ? $pages - $number_count : 1;
                    // $end_number = ($pages < ($total_pages - $number_count)) ? $pages + $number_count : $total_pages;

                    // if($pages == 1) {
                    //     echo '<li class="page-item disabled"><div class="page-link">First</div></li>';
                    //     echo '<li class="page-item disabled"><div class="page-link"><span aria-hidden="true">&laquo;</span></div></li>';
                    //     // echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                    //     // echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                    // } else {
                    //     $link_prev = ($pages > 1) ? $pages - 1 : 1;
                    //     echo '<li class="page-item halaman" id="1"><div class="page-link">First</div></li>';
                    //     echo '<li class="page-item halaman" id="'.$link_prev.'"><div class="page-link"><span aria-hidden="true">&laquo;</span></div></li>';
                    //     // echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                    //     // echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                    // }

                    // for($i = $start_number; $i <= $end_number; $i++){
                    //     $link_active = ($pages == $i) ? ' active' : '';
                    //     echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><div class="page-link">'.$i.'</div></li>';
                    //     // echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
                    // }
            
                    // if($pages == $total_pages){
                    //     echo '<li class="page-item disabled"><div class="page-link"><span aria-hidden="true">&raquo;</span></div></li>';
                    //     echo '<li class="page-item disabled"><div class="page-link">Last</div></li>';
                    //     // echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                    //     // echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                    // } else {
                    //     $link_next = ($pages < $total_pages) ? $pages + 1 : $total_pages;
                    //     echo '<li class="page-item halaman" id="'.$link_next.'"><div class="page-link"><span aria-hidden="true">&raquo;</span></div></li>';
                    //     echo '<li class="page-item halaman" id="'.$total_pages.'"><div class="page-link">Last</div></li>';
                    //     // echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                    //     // echo '<li class="page-item halaman" id="'.$total_pages.'"><a class="page-link" href="#">Last</a></li>';
                    // }
                ?>
            </ul>
        <?php
        }
    ?>
</nav>
