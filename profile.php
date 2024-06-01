

<!DOCTYPE html>
<html lang="ua">
<?php
if(isset($_GET['id'])){
    setcookie('checkuser', $_GET['id'], time()+ 20);
}

?>
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>Головна сторінка</title>
    <link href="CSS/profile.css" rel="stylesheet">
    <script src="JS/profile.js"></script>
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
        <div class="area1-column4">
            <button id="editProfileButton">Edit profile</button>
        </div>
    </div>
    <div class="area2">
        <div class="area2-part1">
            <div class="area2-part1-online">
                <div class="area2-part1-online-row">
                    <h1>Online</h1>
                </div>
                <div class="area2-part1-online-row">
                    <button>News</button>
                </div>
                <div class="area2-part1-online-row">
                    <button>Courses</button>
                </div>
                <div class="area2-part1-online-row">
                    <button>Make publication</button>
                </div>
                <div class="area2-part1-online-row">
                    <button>New trip</button>
                </div>
                <div class="area2-part1-online-row">
                    <button>Add friends</button>
                </div>
            </div>
            <div class="area2-part1-friends">
                <div class="area2-part1-friends-row1">
                    <h1>Best friends</h1>
                </div>
                <div id="friends-list"></div>
            
                <div class="area2-part1-friends-row3">

                    <button>See the full list of your friends</button>
                </div>
            </div>
        </div>
        <div class="area2-part2">
            <div class="area2-part2-row1">
                <button data-modal="modal1">Trips</button>
                <button data-modal="modal2">Publication</button>
                <button data-modal="modal3">Courses</button>
            </div>
            <div class="area2-part2-row2">
                <div id="modal1" class="modal">
                    <div class="modal1-content">
                        <div class="scroll-container">
                            <div class="blockedrow2">
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1">
                                            <img src="">
                                        </div>
                                        <div class="blockedinfoc1-1">
                                            <p>Language of trip: English.</p>
                                        </div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1">
                                            <p>Amount of days: 7.</p>
                                        </div>
                                        <div class="blockedinfoc1-1">
                                            <p>Trip with: Ivan Dukhota.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modal2" class="modal">
                    <div class="modal2-content">
                        <div class="publication-box">
                            <div class="publication-box-leftright-box">
                                <button onclick="showPreviousPublication()">←</button>
                            </div>
                            <div class="publication-box-mid">
                                <div class="publication-box-mid-photo">
                                    <img id="publication-photo" src="">
                                </div>
                                <div class="publication-box-mid-info">
                                    <p id="publication-text"></p>
                                </div>
                            </div>
                            <div class="publication-box-leftright-box">
                                <button onclick="showNextPublication()">→</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modal3" class="modal">
                    <div class="modal3-content">
                        <div class="scroll-container">
                            <div class="blockedrow2">
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1">
                                            <p>Name of Course</p>
                                        </div>
                                        <div class="blockedinfoc1-1">
                                            <p>Language of course: English.</p>
                                        </div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1">
                                            <p>Amount of lessons: 7.</p>
                                        </div>
                                        <div class="blockedinfoc1-1">
                                            <p>teacher: Ivan Dukhota.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                                <div class="m1cr2first12">
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                    <div class="blockedinfoc1">
                                        <div class="blockedinfoc1-1"></div>
                                        <div class="blockedinfoc1-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <div id="editProfileModal" class="modal-edit-profile">
        <div class="modal1-edit-content">
            <div class="edit-window">
                <div class="edit-window-row1">
                    <h1>Edit your profile</h1>
                </div>
                <div class="edit-window-row2">
                    <div class="edit-window-row2-cl1">
                        <img src="">
                        <button>Change photo</button>
                    </div>
                    <div class="edit-window-row2-cl2">
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>Name:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea class="textarea3"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>Place of residence:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea class="textarea3"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>About me:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea class="textarea2"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>New password:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea class="textarea3"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>Repeat password:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea class="textarea3"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows-end">
                            <button class="buttonforedit1">Cancel</button>
                            <button class="buttonforedit2">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>