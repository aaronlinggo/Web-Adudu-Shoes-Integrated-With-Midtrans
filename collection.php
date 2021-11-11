<?php
	session_start();
	require_once("./controller/connection.php");

	$stmt = $conn->prepare("SELECT * FROM sepatu");
	$stmt->execute();
	$sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Collection | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
    </head>
    <body class="main-layout">
        <div class="header_section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="collection_text">Collection</div>
        <div class="layout_padding collection_section">
            <div class="container">
            </div>
        </div>
		<?php require_once("./section/footer_section.php") ?>
		<?php require_once("./section/script_section.php") ?>
    </body>
</html>