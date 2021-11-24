<?php
    $host = 'localhost';
    $user = 'adudumas_admin';
    $password = 'proyekkok2minggu';
    $database = 'adudumas_db_adudu';
    $port = '3306';
    // $conn = new mysqli($host, $user, $password, $database);
    $conn = new mysqli($host, 'root', '', 'db_adudu');

    if($conn -> connect_errno) {
        die("Gagal Connect: " . $conn -> connect_error);
    }
?>
