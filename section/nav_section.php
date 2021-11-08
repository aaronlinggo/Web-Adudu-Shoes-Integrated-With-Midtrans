<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="logo">
                <a href="#">
                    <img src="./images/logo.png">
                </a>
            </div>
        </div>
        <div class="col-sm-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav" style="align-items: center;">
                        <a class="nav-item nav-link" href="./index.php">Home</a>
                        <a class="nav-item nav-link" href="./collection.php">Collection</a>
                        <a class="nav-item nav-link" href="./shoes.php">Shoes</a>
                        <a class="nav-item nav-link last" href="#">
                            <img src="./images/search_icon_black.png">
                        </a>
                        <a class="nav-item nav-link last" href="./cart.php">
                            <img src="./images/shop_icon_black.png">
                        </a>
                        <?php
                        if (!isset($_SESSION['active'])) { ?>
                            <a class="btn btn-outline-danger" href="login.php" style="height: 100%;">Sign In</a>
                            <a class="btn btn-outline-danger" href="register.php" style="height: 100%;">Sign Up</a>
                        <?php } else { ?>
                            <a class="nav-item nav-link" href="#">
                                <img src="./images/user_24px_black.png">
                            </a>
                            <a class="btn btn-outline-danger" href="logout.php" style="height: 100%;">Sign Out</a>
                        <?php }
                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>