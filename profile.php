<!DOCTYPE html>
<html lang="ua">

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
                    <button id="createMeetingButton">New trip</button>
                </div>
                <div class="area2-part1-online-row">
                    <button>Add friends</button>
                </div>
            </div>
            <div class="area2-part1-friends" id="friends-list">
                <div class="area2-part1-friends-row1"></div>
            </div>
        </div>
        <div class="area2-part2">
            <div class="area2-part2-row1">
                <button data-modal="modal1">Trips</button>
                <button data-modal="modal2">Publication</button>
                <button data-modal="modal3">Courses</button>
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

    <!-- Edit profile -->
    <div id="editProfileModal" class="modal-edit-profile">
        <div class="modal1-edit-content">
            <div class="edit-window">
                <div class="edit-window-row1">
                    <h1>Edit your profile</h1>
                </div>
                <div class="edit-window-row2">

                    <div class="edit-window-row2-cl1">
                        <div class="image-container">
                            <img id="profilePhoto" src="" alt="User Image">
                            <div class="overlay" id="photoOverlay">
                                <img src="IMG/add_photo.png" alt="Change photo" class="overlay-image">
                            </div>
                        </div>
                        <div class="photo-buttons">
                            <button id="changePhotoButton">Change photo</button>
                            <button id="removePhotoButton">Remove photo</button>
                            <input type="file" id="fileInput" accept="image/*" style="display: none;">
                        </div>
                    </div>

                    <div class="edit-window-row2-cl2">
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>Name:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea id="nameField" class="textarea3"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>Place of residence:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea id="residenceField" class="textarea3"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>About me:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea id="aboutMeTextarea" class="textarea2"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>New password:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea id="newPasswordField" class="textarea3"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows">
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <p>Repeat password:</p>
                            </div>
                            <div class="edit-window-row2-cl2-rows-rrr">
                                <textarea id="repeatPasswordField" class="textarea3"></textarea>
                            </div>
                        </div>
                        <div class="edit-window-row2-cl2-rows-end">
                            <button class="buttonforedit1">Cancel</button>
                            <button class="buttonforedit2" id="saveButton">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit profile -->

    <!-- Make meetings -->
    <div id="createMeetingModal" class="modal-create-meeting">
        <div class="modal1-edit-content-meeting">
            <div class="container-meeting">
                <button class="close-button" id="closeModalButton">&times;</button>
                <h1 class="title-meeting">Create a New Meeting</h1>
                <div class="form-container">
                    <form id="createMeetingForm" class="form-left">
                        <div>
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" maxlength="100" required>
                            <span class="error-message" id="title-error"></span>
                        </div>
                        <div>
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" required></textarea>
                            <span class="error-message" id="description-error"></span>
                        </div>
                        <div>
                            <label for="language_to_practice">Language to Practice:</label>
                            <input type="text" id="language_to_practice" name="language_to_practice" maxlength="50" required>
                            <span class="error-message" id="language-error"></span>
                        </div>
                        <div>
                            <label for="proficiency_level">Proficiency Level:</label>
                            <input type="text" id="proficiency_level" name="proficiency_level" maxlength="20" required>
                            <span class="error-message" id="proficiency-error"></span>
                        </div>
                        <div>
                            <label for="date_time">Date and Time:</label>
                            <input type="datetime-local" id="date_time" name="date_time" required>
                            <span class="error-message" id="datetime-error"></span>
                        </div>
                        <div>
                            <label for="duration">Duration (hours):</label>
                            <input type="number" id="duration" name="duration" required>
                            <span class="error-message" id="duration-error"></span>
                        </div>
                        <div>
                            <label for="format">Format (online/offline):</label>
                            <select id="format" name="format" required>
                                <option value="online">Online</option>
                                <option value="offline">Offline</option>
                            </select>
                            <span class="error-message" id="format-error"></span>
                        </div>
                        <div>
                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" maxlength="255" required>
                            <span class="error-message" id="location-error"></span>
                        </div>
                        <button class="button-meeting" type="submit">Create Meeting</button>
                    </form>
                    <div class="friends-right">
                        <div>
                            <label for="friendsSearch">Search Friends:</label>
                            <input type="text" id="friendsSearch" placeholder="Search by name...">
                        </div>
                        <div>
                            <label for="friendsFilter">Filter by Country:</label>
                            <select id="friendsFilter">
                                <option value="">All Countries</option>
                            </select>
                        </div>
                        <div>
                            <label for="friends">Invite Friends:</label>
                            <div id="friendsList"></div>
                            <span class="error-message" id="friends-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Make meetings -->
</body>

</html>