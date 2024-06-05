<?php
require "DataBase/db.php";
require_once 'MAP/map.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    session_start();
    $_SESSION['other_user'] = $user_id;
} else {
    exit;
}

?>


<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>Головна сторінка</title>
    <link href="CSS/profile.css" rel="stylesheet">
    <script src="JS/profile1.js"></script>
</head>

<body>
    <?php require "blocks/header.php"; ?>

    <div class="area1">
        <div class="area1-column1">
            <img src="">
        </div>
        <div class="area1-column2">
            <h1>Full Name</h1>
            <p class="place-of-residence">Place of residence</p>
            <p class="about-me">About me...</p>
        </div>
        <div class="area1-column1"></div>
    </div>
    <div class="area2">
        <div class="area2-part1">

            <div class="area2-part1-friends" id="friends-list">
                <div class="area2-part1-friends-row1"></div>
            </div>
        </div>
        <div class="area2-part2">
            <div class="area2-part2-row1">
                <button data-modal="modal1">Trips</button>
                <button data-modal="modal2">Publication</button>
                <button data-modal="modal3">Map</button>
            </div>
            <div class="area2-part2-row2">
                <!-- Check meetings -->
                <div id="modal1" class="modal">
                    <div class="modal1-content">
                        <div class="scroll-container">
                            <div id="meetup-list" class="meetup-list"><!-- My meetings --></div>
                        </div>
                    </div>
                </div>
                <!-- Check meetings -->

                <!-- Check publications -->
                <div class="container">
                    <div id="modal2" class="modal">
                        <div class="modal2-content">
                            <div class="publication-box">
                                <button class="arrow-button" onclick="showPreviousPublication()">&#10094;</button>
                                <div class="publication-box-mid">
                                    <div class="publication-box-mid-photo">
                                        <img id="publication-photo" src="" alt="Publication Photo">
                                    </div>
                                    <div class="publication-box-mid-info">
                                        <p id="publication-text"></p>
                                        <p id="publication-date"></p>
                                    </div>
                                </div>
                                <button class="arrow-button" onclick="showNextPublication()">&#10095;</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Check publications -->

                <div id="modal3" class="modal">
                    <div class="modal3-content-other">
                        <?php
                        getMap($_SESSION['other_user'], $conn);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="area3">
        <div class="area3-head">
            <h1>Comments</h1>
        </div>
        <div id="comments-container" class="area3-mid">
        </div>
        <div class="area3-bottom">
            <button id="prev-button" onclick="showPreviousPage()">&#8592;</button>
            <button id="next-button" onclick="showNextPage()">&#8594;</button>
        </div>
    </div>

    <style>
        .area2-part1 {
            display: grid;
            grid-template-rows: 70% 30%;
        }

        gmp-map {
            height: 95%;
            width: 95%;
            padding: 20px;
        }

        .modal3-content-other {
            background-color: #0a0d22;
            padding: 20px;
            width: 100%;
            max-width: 1062px;
            height: 100%;
            box-sizing: border-box;
            /* display: grid; */
            grid-template-rows: 100%;
        }
    </style>
</body>

</html>