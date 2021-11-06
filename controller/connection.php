<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'db_adudu';
    $port = '3306';
    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_errno) {
        die("gagal connect : " . $conn->connect_error);
    }