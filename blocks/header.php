<?php
require_once __DIR__ . '/../DataBase/db.php';
session_start();
?>

<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img class="bi me-2" width="50" height="38" role="img" src="IMG/1.png" alt="picture">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: 20px;">
                <?php
                $current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : '';

                if ($current_page == 'main') {
                    echo "<li><a href=\"main.php\" class=\"nav-link px-2 text-secondary\">Home</a></li> ";
                } else if ($current_page == 'basket') {
                    echo "<li><a href=\"main.php\" class=\"nav-link px-2 text-white\">Home</a></li> ";
                } else {
                    echo "<li><a href=\"main.php\" class=\"nav-link px-2 text-white\">Home</a></li> ";
                }
                ?>
                <li><a href="main.php" class="nav-link px-2 text-white">Features</a></li>
                <li><a href="upload.php" class="nav-link px-2 text-white">Img</a></li>
                <li><a href="chat.php" class="nav-link px-2 text-white">Chat</a></li>
                <li><a href="courses.php" class="nav-link px-2 text-white">Courses</a></li>
            </ul>

            <div class="text-end">
                <a href="basket.php" class="btn btn-warning">
                    <img class="bi me-2" width="25" height="22" role="img" src="IMG/bascet.png" alt="picture">
                </a>
            </div>

            <div class="text-end">
                <?php
                if (isset($_COOKIE['user'])) {
                    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : $_COOKIE['user'];

                    $query = $conn->query("SELECT photo FROM User WHERE user_id = {$userId}");
                    $row = $query->fetch_assoc();
                    $img = base64_encode($row['photo']);

                    echo "<a href=\"registration.php\" style=\"margin-left: 15px;\" class=\"btn btn-warning\"><img src=\"data:image/jpeg;base64, $img \" alt=\"\"></a>";
                } else {
                    echo "<a href=\"registration.php\" style=\"margin-left: 15px;\" class=\"btn btn-warning\">Sign-up</a>";
                }
                ?>

            </div>

        </div>
    </div>
</header>