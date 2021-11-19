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
        <!-- </div>
        <div class="collection_text">About Us</div> -->
        <div class="layout_padding collection_section" style="padding-top: 15px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-end">
                        <div style="margin-bottom: 100px;">
                            <div class="lorem_text">ABOUT</div>
                            <h1 class="mens_text" style="font-weight: 600;">PROFILE</h1>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <img class="img-fluid" data-controller="lazyLoader" alt="" src="https://www.adidas-group.com/media/filer_public_thumbnails/filer_public/66/69/66693d7c-bc7b-4681-abd3-921644732c5c/18_02_2021_profile.jpg__800x900_q85_crop-smart_subject_location-2055%2C1037_subsampling-2.jpg" data-src="/media/filer_public_thumbnails/filer_public/66/69/66693d7c-bc7b-4681-abd3-921644732c5c/18_02_2021_profile.jpg__800x900_q85_crop-smart_subject_location-2055%2C1037_subsampling-2.jpg" style="width: 800px; height: 700px;">
                    </div>
                </div>
                <div class="layout_padding d-flex flex-column align-items-center">
                    <div class="lorem_text">
                        The adudu brand has a long history and deep-rooted connection with sport. Its broad and diverse portfolio in both the Sport Performance and Sport Inspired categories ranges from major global sports to regional grassroot events  and local sneaker culture. This has enabled adidas to transcend cultures and become one of the most recognized, credible, and iconic brands both on and off the field of play.
                    </div>
                    <h2 class="mens_text" style="font-weight: 600; margin: 45px 0;">OUR PURPOSE</h2>
                    <div>
                        <img class="img-fluid" src="https://www.adidas-group.com/media/filer_public_thumbnails/filer_public/76/41/7641dd9b-e0b1-4a9f-8b38-8d545a0fd6ee/05_08_2021_purpose.jpg__1028x0_q85_crop-smart_subsampling-2.jpg" alt="" data-src="/media/filer_public_thumbnails/filer_public/76/41/7641dd9b-e0b1-4a9f-8b38-8d545a0fd6ee/05_08_2021_purpose.jpg__1028x0_q85_crop-smart_subsampling-2.jpg" data-controller="lazyLoader" data-modal-content="modal-871111" data-action="click->modalHandler#createModal">
                    </div>
                    <div class="lorem_text" style="margin: 40px 0;">
                        Everything we do is rooted in sport. Sport plays an increasingly important role in more and more people’s lives, on and off the field of play. It is central to every culture and society and is core to our health and happiness.   
                        <br>
                        <br>
                        Our purpose, ‘through sport, we have the power to change lives’, guides the way we run our company, how we work with our partners, how we create our products, and how we engage with our consumers. We will always strive to expand the limits of human possibilities, to include and unite people in sport, and to create a more sustainable world.  
                        <br>
                        <br>
                        To experience how our employees and partners are driving change through purpose – and how you can find purpose, too
                    </div>
                    <h2 class="mens_text" style="font-weight: 600; margin: 45px 0;">OUR MISSION</h2>
                    <div>
                        <img class="absolute w-full h-full object-cover transition-opacity cursor-pointer m:cursor-default m:pointer-events-none" src="https://www.adidas-group.com/media/filer_public_thumbnails/filer_public/15/b3/15b39aae-8061-4d69-9d15-6cd6e9cf2bae/05_08_2021_mission.jpg__1028x0_q85_crop-smart_subsampling-2.jpg" alt="" data-src="/media/filer_public_thumbnails/filer_public/15/b3/15b39aae-8061-4d69-9d15-6cd6e9cf2bae/05_08_2021_mission.jpg__1028x0_q85_crop-smart_subsampling-2.jpg" data-controller="lazyLoader" data-modal-content="modal-871114" data-action="click->modalHandler#createModal">
                    </div>
                    <div class="lorem_text" style="margin: 40px 0;">
                        Athletes do not settle for average. And neither do we. We have a clear mission: To be the best sports brand in the world. Every day, we come to work to create and sell the best sports products in the world, and to offer the best service and consumer experience – and to do it all in a sustainable way. We are the best when we are the credible, inclusive, and sustainable leader in our industry.
                    </div>
                    <h2 class="mens_text" style="font-weight: 600; margin: 45px 0;">OUR ATTITUDE</h2>
                    <div>
                        <img class="absolute w-full h-full object-cover transition-opacity cursor-pointer m:cursor-default m:pointer-events-none" src="https://www.adidas-group.com/media/filer_public_thumbnails/filer_public/73/75/7375fc1d-b4cd-4171-9c33-f03de7296b59/05_08_2021_attitude.jpg__1028x0_q85_crop-smart_subsampling-2.jpg" alt="" data-src="/media/filer_public_thumbnails/filer_public/73/75/7375fc1d-b4cd-4171-9c33-f03de7296b59/05_08_2021_attitude.jpg__1028x0_q85_crop-smart_subsampling-2.jpg" data-controller="lazyLoader" data-modal-content="modal-871117" data-action="click->modalHandler#createModal">
                    </div>
                    <div class="lorem_text" style="margin: 40px 0;">
                        At adidas, we are rebellious optimists driven by action, with a desire to shape a better future together. We see the world of sport and culture with possibility where others only see the impossible. ‘Impossible is Nothing’ is not a tagline for us. By being optimistic and knowing the power of sport, we see endless possibilities to apply this power and push all people forward with action.
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column align-items-start" style="text-align: left; padding: 2% 5%;">
                    <div class="lorem_text" style="color: white; font-weight: 600; font-size: 1.3rem;">
                        FOLLOW US ON
                        <img src="./images/GitHub_Logo_White.png" alt="" style="width: 65px;">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-6 d-flex flex-column align-items-start" style="text-align: left; padding: 2% 5%;">
                        <div class="lorem_text" style="color: white; font-weight: normal; font-size: 1.1rem;">
                        Develop by :
                        <br>
                        Aaron & Samuel
                    </div>
                </div>
            </div>
            <hr style="border:1px solid lightgray; width: 90%;">
        </div>
		<?php require_once("./section/footer_section.php") ?>
		<?php require_once("./section/script_section.php") ?>
    </body>
</html>