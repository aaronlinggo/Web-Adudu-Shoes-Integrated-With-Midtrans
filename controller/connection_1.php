<?php
    $host = 'localhost';
    $user = 'adudumas_admin';
    $password = 'proyekkok2minggu';
    $database = 'adudumas_db_adudu';
    $port = '3306';
    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_errno) {
        die("gagal connect : " . $conn->connect_error);
    }