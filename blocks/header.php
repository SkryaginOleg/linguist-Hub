<header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img class="bi me-2" width="50" height="38" role="img" src="IMG/1.png" alt="picture">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"
                    style="margin-left: 20px;">
                    <?php
                    $current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : '';

                         if($current_page == 'main') {
                            echo"<li><a href=\"main.php\" class=\"nav-link px-2 text-secondary\">Home</a></li> ";
                        } else if($current_page == 'basket') {
                            echo"<li><a href=\"main.php\" class=\"nav-link px-2 text-white\">Home</a></li> ";
                        }
                    ?>
                    <li><a href="main.php" class="nav-link px-2 text-white">Features</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">About</a></li>
                </ul>

                <div class="text-end">
                        <a href="/Linguist Hub\bascet.php" class="btn btn-warning"> 
                            <img class="bi me-2" width="25" height="22" role="img" src="IMG/bascet.png" alt="picture">
                        </a>
                </div>

                <div class="text-end">
                        <a href="/auth.php" style = "margin-left: 15px;" class="btn btn-warning">Sign-up</a>
                </div>
            </div>
        </div>
    </header>