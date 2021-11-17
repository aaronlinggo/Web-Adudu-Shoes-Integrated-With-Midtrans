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
        <title>About Us | Adudu Shoes</title>
        <?php require_once("./section/connection_head.php") ?>
    </head>
    <body class="main-layout">
        <div class="header_section">
            <?php require_once("./section/nav_section.php") ?>
        </div>
        <div class="collection_text">About Us</div>
        <div class="layout_padding collection_section">
            <div class="container">
                <h1 class="new_text"><strong>New Collection</strong></h1>
                <p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                <div class="collection_section_2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="about-img">
                                <button class="new_bt">New</button>
                                <div class="shoes-img"><img src="./images/shoes-img1.png"></div>
                                <p class="sport_text">Men Sports</p>
                                <div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
                                <div class="star_icon">
                                    <ul>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <button class="seemore_bt">See More</button>
                        </div>
                        <div class="col-md-6">
                            <div class="about-img2">
                                <div class="shoes-img2"><img src="./images/shoes-img2.png"></div>
                                <p class="sport_text">Men Sports</p>
                                <div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
                                <div class="star_icon">
                                    <ul>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                        <li><a href="#"><img src="./images/star-icon.png"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php require_once("./section/footer_section.php") ?>
		<?php require_once("./section/script_section.php") ?>
    </body>
</html>