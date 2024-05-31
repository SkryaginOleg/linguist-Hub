<?php
require_once __DIR__ . '/../DataBase/db.php';
session_start();
?>


<head>
<style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #343a40;
            color: white;
        }

        .container {
            max-width: 1700px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left-section {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 50px;
            height: 38px;
        }

        .nav {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            margin-left: 20px;
        }

        .nav li {
            display: inline;
        }

        .nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
        }

        .nav a:hover,
        .nav a.text-secondary {
            color: #adb5bd;
        }

        .btn {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background-color: #ffc107;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 0.25rem;
        }

        .btn img {
            margin-right: 0.5rem;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .right-buttons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .nav {
                flex-direction: column;
                align-items: center;
                margin-left: 0;
                margin-top: 1rem;
            }

            .right-buttons {
                margin-top: 1rem;
                flex-direction: column;
            }

            .profile-btn {
                margin-left: 0;
                margin-top: 1rem;
            }
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .profile-img {
            border-color: #ffc107;
        }
    </style>
    <script>
    document.addEventListener('click', function(event) {
        var dropdown = document.querySelector('.dropdown-content');
        var profileImg = document.querySelector('.profile-img');
        if (profileImg.contains(event.target)) {
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });
</script>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="left-section">
                <a href="/" class="logo">
                    <img src="IMG/1.png" alt="picture">
                </a>
                <ul class="nav">
                    <?php
                    $current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : '';

                    if ($current_page == 'main') {
                        echo "<li><a href=\"index.php\" class=\"text-secondary\">Home</a></li>";
                    } else if ($current_page == 'basket') {
                        echo "<li><a href=\"index.php\">Home</a></li>";
                    } else {
                        echo "<li><a href=\"index.php\">Home</a></li>";
                    }
                    ?>
                    <li><a href="main.php">Features</a></li>
                    <li><a href="upload.php">Img</a></li>
                    <li><a href="chat.php">Chat</a></li>
                    <li><a href="courses.php">Courses</a></li>
                </ul>
            </div>
            <div class="right-buttons">
                <a href="basket.php" class="btn">
                    <img src="IMG/bascet.png" width="25" height="22" alt="picture">
                </a>
                <?php
                if (isset($_COOKIE['user'])) {
                    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : $_COOKIE['user'];

                    $query = $conn->query("SELECT photo FROM User WHERE user_id = {$userId}");

                    $row = $query->fetch_assoc();
                    if (isset($row)) {
                        $img = base64_encode($row['photo']);
                    } else {
                        $default_image_path = "IMG/user_male4-256.webp";
                        $img = base64_encode(file_get_contents($default_image_path));
                    }

                    echo "<div class=\"dropdown\"><img src=\"data:image/jpeg;base64,$img\" class=\"profile-img\" alt=\"\">";
                    echo "<div class=\"dropdown-content\">";
                    echo "<a href=\"profile.php\">Profile</a>";
                    echo "<a href=\"settings.php\">Settings</a>";
                    echo "<a href=\"registration.php\">Logout</a>";
                    echo "</div></div>";
                } else {
                    echo "<a href=\"registration.php\" class=\"btn profile-btn\">Sign-up</a>";
                }
                ?>
            </div>
        </div>
    </header>
</body>

</html>