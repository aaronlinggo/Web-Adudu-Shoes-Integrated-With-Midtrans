<?php
session_start();
require_once("./controller/connection.php");

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Sign In</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php require_once("./section/connection_head.php") ?>
</head>
<body class="main-layout">
    <div class="header_section">
        <?php require_once("./section/nav_section.php") ?>
    </div>
    <div class="collection_text">Cart</div>
    <div class="layout_padding contact_section">
        <div class="container-fluid ram">
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
        </div>
    </div>
    <?php require_once("./section/footer_section.php") ?>
    <?php require_once("./section/script_section.php") ?>
</body>

</html>