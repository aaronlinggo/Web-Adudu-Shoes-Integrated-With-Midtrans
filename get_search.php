<?php
    $query = $_POST['query'];

    ob_start();
    include "get_catalog.php";
    $html = ob_get_contents();
    ob_end_clean();

    echo json_encode(array('hasil' => $html));
?>
