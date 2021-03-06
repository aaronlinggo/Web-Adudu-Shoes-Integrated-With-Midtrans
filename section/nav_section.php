<div class="header-inner container">
    <div class="row flex-row" style="position: relative;">
        <div class="landing-padding col-sm-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light flex flex-hend flex-between fullheight">
                <div class="logo">
                    <a href="./" class="flex flex-hstart">
                        <img class="top-logo" src="./images/logo_2.png">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle Navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav flex flex-row flex-between flex-vcenter fullwidth">
                        <div class="medium-scale flex flex-between">
                            <a class="nav-item nav-link nav-android-menu" href="./">Home</a>
                            <a class="nav-item nav-link nav-android-menu" href="./aboutus.php">About</a>
                            <a class="nav-item nav-link nav-android-menu" href="./shoes.php">Shoes</a>
                            <a class="nav-item nav-link nav-android-menu last" href="./shoes.php?input-search=true">Search</a>
                            <a class="nav-item nav-link nav-android-menu last" href='<?= (!isset($_SESSION['active'])) ? "./login.php" : "./midtrans/index.php/snap" ?>'>Cart</a>
                            <div id="search_icon" class="nav-item nav-link last flex-center" style="cursor: pointer; position: relative;">
                                <img id="search_img" src="./images/search_icon_black.png">
                            </div>
                            <a class="nav-item nav-link last flex-center" href='<?= (!isset($_SESSION['active'])) ? "./login.php" : "./midtrans/index.php/snap" ?>' style="position: relative;">
                                <img src="./images/shop_icon_black_2.png">
                            </a>
                        </div>
                        <?php
                            if(!isset($_SESSION['active'])) {
                            ?>
                                <div class="medium-scale flex flex-vcenter flex-between">
                            <?php
                            } else {
                            ?>
                                <div class="medium-scale flex flex-vcenter flex-hend">
                            <?php
                            }

                            if(!isset($_SESSION['active'])) {
                            ?>
                                <a class="role-out btn btn-outline-success fullheight" href="./login.php">Sign In</a>
                                <a class="role-out btn btn-outline-danger fullheight" href="./register.php">Sign Up</a>
                            <?php
                            } else {
                                if(isset($_SESSION['activeRoles'])) {
                                    if($_SESSION['activeRoles'] == "Customer") {
                                    ?>
                                        <a class="nav-item nav-link profile flex flex-hend" href="./profile.php">
                                            <img src="./images/user_24px_black.png">
                                        </a>
                                    <?php
                                    } else if($_SESSION['activeRoles'] == "admin") {
                                    ?>
                                        <a class="nav-item nav-link profile flex flex-hend" href="./admin/index.php">
                                            <img src="./images/user_24px_black.png">
                                        </a>
                                    <?php
                                    }
                                }
                                ?>
                                <a class="btn btn-outline-danger fullheight" href="./logout.php">Sign Out</a>
                            <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
