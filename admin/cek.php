<?php
session_start();
require_once("../controller/connection.php");

echo "<pre>";
var_dump($_FILES['imagesShoes']);
echo "<hr>";
var_dump($_POST);
echo "</pre>";
?>