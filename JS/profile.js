let userData = {};

document.addEventListener('DOMContentLoaded', function () {

    loadUser(pageFilling);
    loadFriends(pageFilling);
    seeMeetings();

    const buttons = document.querySelectorAll('.area2-part2-row1 button');
    const modals = document.querySelectorAll('.modal, .modal-edit-profile, .modal-create-meeting');

    const editProfileButton = document.getElementById('editProfileButton');
    const editProfileModal = document.getElementById('editProfileModal');
    const cancelEditButton = document.querySelector('.buttonforedit1');
    const aboutMeTextarea = document.getElementById('aboutMeTextarea');
    const profilePhoto = document.getElementById('profilePhoto');
    const saveButton = document.getElementById('saveButton');

    const createMeetingButton = document.getElementById('createMeetingButton');
    const createMeetingModal = document.getElementById('createMeetingModal');
    const cancelСreateMeeting = document.querySelector('.close-button');

    const postPublicationButton = document.getElementById('postPublicationButton');
    const postPublicationModal = document.getElementById('postPublicationModal');
    const publicationPhoto = document.getElementById('publicationPhoto');
    const cancelPostPublication = document.querySelector('.buttonforcreate1');

    let isEditProfileModalOpen = false;
    let isCreateMeetingModalOpen = false;
    let iPostPublicationModalOpen = false;

    function closeAllModals() {
        modals.forEach(modal => modal.style.display = 'none');
        if (isEditProfileModalOpen) {
            document.body.classList.remove('no-scroll');
            isEditProfileModalOpen = false;
        }
        if (isCreateMeetingModalOpen) {
            document.body.classList.remove('no-scroll');
            isCreateMeetingModalOpen = false;
        }
    }

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.getAttribute('data-modal');
            const modal = document.getElementById(modalId);

            if (modal) {
                closeAllModals();
                modal.style.display = 'block';
            }
        });
    });

    //Відображення сторінки Еdit Profile
    editProfileButton.addEventListener('click', function () {
        if (userData.photo) {
            profilePhoto.src = userData.photo;
        }
        else {
            profilePhoto.src = 'IMG/user_male4-256.webp';
        }
        document.getElementById('nameField').value = userData.full_name;
        document.getElementById('residenceField').value = userData.country;
        document.getElementById('aboutMeTextarea').value = userData.information;
        document.getElementById('newPasswordField').value = "";
        document.getElementById('repeatPasswordField').value = "";


        requestAnimationFrame(function () {
            aboutMeTextarea.style.height = '40px';
            aboutMeTextarea.style.height = (aboutMeTextarea.scrollHeight) + 'px';
        });

        editProfileModal.style.display = 'flex';
        document.body.classList.add('no-scroll');
        isEditProfileModalOpen = true;
    });

    //Відображення сторінки Сreate Meeting
    createMeetingButton.addEventListener('click', function () {
        createMeetingModal.style.display = 'flex';
        document.body.classList.add('no-scroll');
        isCreateMeetingModalOpen = true;
    });

    //Відображення сторінки Post Publication
    postPublicationButton.addEventListener('click', function () {
        postPublicationModal.style.display = 'flex';
        document.body.classList.add('no-scroll');
        iPostPublicationModalOpen = true;

        publicationPhoto.src = 'IMG/user_male4-256.webp';
    });

    //Перевірка вписаних користувачем значень / редагування даних
    saveButton.addEventListener('click', function () {
        let full_name = document.getElementById('nameField');
        let country = document.getElementById('residenceField');
        let information = document.getElementById('aboutMeTextarea');
        let repeatPassword = document.getElementById('repeatPasswordField');
        let password = document.getElementById('newPasswordField');

        var correctForm = validateForm(full_name, "full_name") && validateForm(country, "country");

        if (!correctForm) {
            return false;
        }
        else if (password.value.trim() !== "") {
            if (password.value.trim() !== repeatPassword.value.trim()) {
                var message = "Паролі не співпадають.";
                addError(repeatPassword, message);
                return false;
            }
        }

        var formData = {
            full_name: full_name.value.trim(),
            country: country.value.trim(),
            information: information.value.trim(),
            password: password.value.trim()
        };

        $.ajax({
            url: "actions/get_messages.php?action=edit_data",
            type: "POST",
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    console.log('Data saved successfully.');
                    loadUser(pageFilling);
                    cancelEditButton.click();
                } else {
                    console.error('Помилка: ' + response.message);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.error('Помилка: ' + errorThrown);
            }
        });
    });

    //Закритя сторінки Еdit Profile
    cancelEditButton.addEventListener('click', function () {
        editProfileModal.style.display = 'none';
        document.body.classList.remove('no-scroll');
        isEditProfileModalOpen = false;
    });

    //Закритя сторінки Post Publication
    cancelPostPublication.addEventListener('click', function () {
        postPublicationModal.style.display = 'none';
        document.body.classList.remove('no-scroll');
        iPostPublicationModalOpen = false;
    });

    //Закритя сторінки Сreate Meeting
    cancelСreateMeeting.addEventListener('click', function () {
        createMeetingModal.style.display = 'none';
        document.body.classList.remove('no-scroll');
        isCreateMeetingModalOpen = false;
    });

    //Відсклідковування змін у textarea3
    document.querySelectorAll('.textarea3').forEach(textarea => {
        textarea.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    });

    //Автоматичне встановлення висоти для aboutMeTextarea
    aboutMeTextarea.addEventListener('input', function () {
        this.style.height = '40px';
        this.style.height = (this.scrollHeight) + 'px';
    });
    aboutMeTextarea.style.height = '40px';

    //Видалення помилок
    function removeError(input) {
        input.classList.remove("error");
        var errorMessage = input.parentNode.querySelector(".error-message");
        if (errorMessage) {
            errorMessage.parentNode.removeChild(errorMessage);
        }
    }

    //Видалення вказівок на помилки при редагувані поля вводу
    document.querySelectorAll('textarea').forEach(function (input) {
        input.addEventListener('input', function () {
            removeError(input);
        });
    });



    //МОДАЛЬНЕ ВІКНО ДЛЯ СТВОРЕННЯ ЗУСТРІЧІ
    $(document).ready(function () {
        function autoExpandTextarea(field) {
            field.style.height = 'auto';
            field.style.height = (field.scrollHeight) + 'px';
        }

        $('#description').on('input', function () {
            autoExpandTextarea(this);
        });

        let friends = [];

        function displayFriends(filteredFriends) {
            let friendsList = $('#friendsList');
            friendsList.empty();
            filteredFriends.forEach(friend => {
                let friendElement = `
                    <div class="friend-checkbox">
                        <input type="checkbox" name="friends" id="friend_${friend.user_id}" value="${friend.user_id}">
                        <label for="friend_${friend.user_id}">
                            <img src="${friend.photo}" alt="Friend's photo">
                            <span>${friend.full_name} (${friend.country ? friend.country : 'Not indicated'})</span>
                        </label>
                    </div>
                `;
                friendsList.append(friendElement);
            });
        }

        function filterFriends() {
            let searchQuery = $('#friendsSearch').val().toLowerCase();
            let selectedCountry = $('#friendsFilter').val();

            let filteredFriends = friends.filter(friend => {
                let matchesSearch = friend.full_name.toLowerCase().includes(searchQuery);
                let matchesCountry = selectedCountry === '' || friend.country === selectedCountry;
                return matchesSearch && matchesCountry;
            });

            displayFriends(filteredFriends);
        }

        $('#friendsSearch, #friendsFilter').on('input change', function () {
            filterFriends();
        });

        $.ajax({
            url: 'actions/get_friends.php?action=get_friends',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                friends = response;
                displayFriends(friends);

                let countries = [...new Set(friends.map(friend => friend.country))].sort();
                let friendsFilter = $('#friendsFilter');
                countries.forEach(country => {
                    friendsFilter.append(new Option(country, country));
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching friends:', error);
            }
        });

        $('#createMeetingForm').on('submit', function (event) {
            event.preventDefault();

            $('.error-message').text('');

            let isValid = true;

            if ($('#title').val().trim() === '') {
                isValid = false;
                $('#title-error').text('Title is required.');
            }

            if ($('#description').val().trim() === '') {
                isValid = false;
                $('#description-error').text('Description is required.');
            }

            if ($('#language_to_practice').val().trim() === '') {
                isValid = false;
                $('#language-error').text('Language to practice is required.');
            }

            if ($('#proficiency_level').val().trim() === '') {
                isValid = false;
                $('#proficiency-error').text('Proficiency level is required.');
            }

            if ($('#date_time').val().trim() === '') {
                isValid = false;
                $('#datetime-error').text('Date and time are required.');
            }

            if ($('#duration').val().trim() === '' || $('#duration').val() <= 0) {
                isValid = false;
                $('#duration-error').text('Duration must be a positive number.');
            }

            if ($('#format').val() === '') {
                isValid = false;
                $('#format-error').text('Format is required.');
            }

            if ($('#location').val().trim() === '') {
                isValid = false;
                $('#location-error').text('Location is required.');
            }

            if (!isValid) {
                return;
            }

            let formData = $(this).serializeArray();
            let friends = [];
            $('input[name="friends"]:checked').each(function () {
                friends.push($(this).val());
            });

            let data = {
                title: $('#title').val(),
                description: $('#description').val(),
                language_to_practice: $('#language_to_practice').val(),
                proficiency_level: $('#proficiency_level').val(),
                date_time: $('#date_time').val(),
                duration: $('#duration').val(),
                format: $('#format').val(),
                location: $('#location').val(),
                friends: friends
            };

            $.ajax({
                url: 'actions/create_meeting.php',
                method: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function (response) {
                    alert('Meeting created successfully!');
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    console.error('Error creating meeting:', error);
                    alert('Failed to create meeting.');
                }
            });
        });
    });
    //МОДАЛЬНЕ ОКНО ДЛЯ СТВОРЕННЯ ЗУСТРІЧІ

});


//Перевірка поля вводу
function validateForm(inputFieleds, type) {
    if (inputFieleds.value.trim() === "") {
        var message;

        switch (type) {
            case "full_name":
                message = "Введіть своє ім'я";
                break;
            case "country":
                message = "Введіть країну";
                break;
        }
        addError(inputFieleds, message)

        return false;
    }
    return true;
}

//Додавання повідомлення о помилке
function addError(inputFieleds, message) {
    if (!inputFieleds.classList.contains("error")) {
        inputFieleds.classList.add("error");
        var errorMessage = document.createElement("div");
        errorMessage.className = "error-message";
        errorMessage.textContent = message;
        inputFieleds.parentNode.appendChild(errorMessage);
    }
}



// Витяг всіх даних про користувача
function loadUser(callback) {
    $.ajax({
        url: "actions/get_messages.php?action=get_user",
        dataType: 'json',
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
        }
    })
        .done(function (data) {
            userData = {
                full_name: data[0].full_name,
                email: data[0].email,
                password: data[0].password,
                photo: data[0].photo,
                birthday: data[0].birthday,
                country: data[0].country,
                information: data[0].information,
                ban_status: data[0].ban_status
            };

            console.log('User data:', userData);
            if (callback && typeof callback === 'function') {
                callback();
            }
        });
}

// Витяг всіх даних про друзів
function loadFriends(callback) {
    $.ajax({
        url: "actions/get_messages.php?action=get_friends",
        dataType: 'json',
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
        }
    })
        .done(function (data) {
            let friendsList = $('#friends-list');
            friendsList.empty();

            let friendTitle = `
            <div class="area2-part1-friends-row1">
                <a href = "./friend.php"><h1>Friends</h1></a>
            </div>
            `;

            friendsList.append(friendTitle);

            let count = 0;

            data.forEach(friend => {
                let friendElement = `
                <div class="area2-part1-friends-row2">
                    <div class="area2-part1-friends-row2-cl1">
                        <img src="${friend.photo}" alt="Friend's photo">
                        <p>${friend.full_name}</p>
                    </div>
                    <div class="area2-part1-friends-row2-cl2">
                        <img src="IMG/menu.webp" alt="Description of the image">
                    </div>
                </div>
            `;
                if (count++ <= 6) {
                    friendsList.append(friendElement);
                }
            });

            console.log('Friends data:', data);
            if (callback && typeof callback === 'function') {
                callback();
            }
        });
}

// Заповнення сторінки
function pageFilling() {

    let userInfo = userData;
    const photo = document.querySelector('.area1-column1 img');
    const name = document.querySelector('.area1-column2 h1');
    const country = document.querySelector('.area1-column2 .place-of-residence');
    const information = document.querySelector('.area1-column2 .about-me');

    const userName = userInfo.full_name;
    const userEmail = userInfo.email;
    const userPassword = userInfo.password;
    const userPhoto = userInfo.photo;
    const userBirthday = userInfo.birthday;
    const userInformation = userInfo.information;
    const userCountry = userInfo.country;
    const userBanStatus = userInfo.ban_status;

    if (userPhoto) {
        photo.src = userPhoto;
    } else {
        photo.src = "IMG/user_male4-256.webp";
    }

    if (userName) {
        name.textContent = userName;
    } else {
        name.textContent = "Unnamed User";
    }

    if (userCountry) {
        country.textContent = userCountry;
    } else {
        country.textContent = "No place of residence provided";
    }

    if (userInformation) {
        information.textContent = userInformation;
    } else {
        information.textContent = "No information provided";
    }

}

document.addEventListener('DOMContentLoaded', function () {

    // Відкриття провідника натисканням на фото
    document.getElementById('photoOverlay').addEventListener('click', function () {
        document.getElementById('fileInput').click();
    });


    // Робота з провідником
    document.getElementById('fileInput').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('profilePhoto').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Відкриття провідника натисканням на фото
    document.getElementById('photoOverlayPublication').addEventListener('click', function () {
        document.getElementById('fileInputPost').click();
    });


    // Робота з провідником
    document.getElementById('fileInputPost').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('publicationPhoto').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });


    // Заміна фото
    document.getElementById('changePhotoButton').addEventListener('click', function () {
        var selectedImageFile = document.getElementById('fileInput').files[0];

        if (!selectedImageFile) {
            console.error('Файл не обрано');
            return;
        }

        var formData = new FormData();
        formData.append('img_upload', selectedImageFile);

        $.ajax({
            url: "actions/get_messages.php?action=chenge_photo&task=save",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    document.querySelector('.area1-column1 img').src = response.photo;
                    document.querySelector('#headerImage img').src = response.photo;
                    userData.photo = response.photo;
                } else {
                    console.error('Помилка: ' + response.message);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.error('Помилка: ' + errorThrown);
            }
        });
    });


    // Видалення фото
    document.getElementById('removePhotoButton').addEventListener('click', function () {

        $.ajax({
            url: "actions/get_messages.php?action=chenge_photo&task=delete",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    document.getElementById('profilePhoto').src = response.photo;
                    document.querySelector('.area1-column1 img').src = response.photo;
                    document.querySelector('#headerImage img').src = response.photo;
                    userData.photo = response.photo;
                    document.getElementById('fileInput').value = null;
                } else {
                    console.error('Помилка: ' + response.message);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.error('Помилка: ' + errorThrown);
            }
        });
    });



    // Створення новох публікації
    document.getElementById('createButton').addEventListener('click', function () {
        var selectedImageFile = document.getElementById('fileInputPost').files[0];
        var text = document.getElementById('descriptionField').value;

        if (!selectedImageFile) {
            console.error('Файл не обрано');
            return;
        }

        var formData = new FormData();
        formData.append('img_upload', selectedImageFile);
        formData.append('text', text);

        $.ajax({
            url: "actions/get_messages.php?action=post_publication",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    postPublicationModal.style.display = 'none';
                    document.body.classList.remove('no-scroll');
                    iPostPublicationModalOpen = false;
                } else {
                    console.error('Помилка: ' + response.message);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.error('Помилка: ' + errorThrown);
            }
        });
    });

    // Відкриття провідника натисканням на фото
    document.getElementById('photoOverlay').addEventListener('click', function () {
        document.getElementById('fileInputPublication').click();
    });


    // Робота з провідником
    document.getElementById('fileInputPublication').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('publicationPhoto').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});

//Функція перегляду усіх зустрічей (Одобрення/Відхилення)
function seeMeetings() {
    $.ajax({
        url: 'actions/get_messages.php?action=get_meetings',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                const meetings = response.meetings;
                const meetupList = $('#meetup-list');
                meetupList.empty();

                meetings.forEach(function (meeting, index) {
                    const meetupCard = $(`
                    <div class="meetup-card" data-index="${index}" data-meeting-id="${meeting.meeting_id}"">
                        <div class="meetup-header">
                            <img src="${meeting.organizer_photo}" alt="Organizer Photo" class="organizer-photo">
                            <div class="organizer-info">
                                <h2 class="organizer-name">${meeting.organizer_name}</h2>
                                <p class="organizer-country">${meeting.organizer_country}</p>
                            </div>
                            <div class="accepted-check" style="display: ${meeting.confirmed ? 'block' : 'none'};">✔</div>
                        </div>
                        <div class="meetup-body">
                            <h2 class="meeting-title">${meeting.title}</h2>
                            <p class="meeting-description">${meeting.description}</p>
                            <div class="meetup-details">
                                <div class="detail-item">
                                    <span class="detail-label">Date:</span>
                                    <span class="detail-value">${meeting.date}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Duration:</span>
                                    <span class="detail-value">${meeting.duration} days</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Location:</span>
                                    <span class="detail-value">${meeting.location}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Language:</span>
                                    <span class="detail-value">${meeting.language}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Proficiency Level:</span>
                                    <span class="detail-value">${meeting.proficiency_level}</span>
                                </div>
                            </div>
                            <div class="meetup-actions">
                                <button style="display: ${meeting.confirmed ? 'none' : 'block'};" class="accept-btn">Accept</button>
                                <button style="display: ${meeting.confirmed ? 'none' : 'block'};" class="reject-btn">Reject</button>
                            </div>
                        </div>
                    </div>
                `);

                    meetupList.append(meetupCard);

                    const acceptBtn = meetupCard.find('.accept-btn');
                    const rejectBtn = meetupCard.find('.reject-btn');
                    const acceptedCheck = meetupCard.find('.accepted-check');
                    const meetingId = meetupCard.data('meeting-id');

                    acceptBtn.click(function () {

                        $.ajax({
                            url: 'actions/get_messages.php?action=confirm_participation',
                            method: 'POST',
                            data: {
                                meeting_id: meetingId
                            },
                            success: function (response) {
                                acceptBtn.hide();
                                rejectBtn.hide();
                                acceptedCheck.show();
                            },
                            error: function (xhr, status, error) {
                                console.error('AJAX Error:', error);
                            }
                        });

                    });

                    rejectBtn.click(function () {
                        $.ajax({
                            url: 'actions/get_messages.php?action=reject_participation',
                            method: 'POST',
                            data: {
                                meeting_id: meetingId
                            },
                            success: function (response) {
                                meetupCard.remove();
                            },
                            error: function (xhr, status, error) {
                                console.error('AJAX Error:', error);
                            }
                        });
                    });
                });
            } else {
                console.error('Error:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
}
































let currentPage = 1;
const totalPages = 4;

document.addEventListener("DOMContentLoaded", function () {
    showComments(currentPage);
});

function showComments(page) {
    const commentsContainer = document.getElementById('comments-container');
    commentsContainer.innerHTML = '';

    let comments = [];

    if (page === 1) {
        comments = [{
            name: 'Full Name1',
            comment: 'Comment of user1',
            photo: 'path/to/photo1.jpg'
        },
        {
            name: 'Full Name2',
            comment: 'Comment of user2',
            photo: 'path/to/photo2.jpg'
        },
        {
            name: 'Full Name3',
            comment: 'Comment of user3',
            photo: 'path/to/photo3.jpg'
        }
        ];
    } else if (page === 2) {
        comments = [{
            name: 'Full Name4',
            comment: 'Comment of user4',
            photo: 'path/to/photo4.jpg'
        },
        {
            name: 'Full Name5',
            comment: 'Comment of user5',
            photo: 'path/to/photo5.jpg'
        },
        {
            name: 'Full Name6',
            comment: 'Comment of user6',
            photo: 'path/to/photo6.jpg'
        }
        ];
    } else if (page === 3) {
        comments = [{
            name: 'Full Name7',
            comment: 'Comment of user7',
            photo: 'path/to/photo7.jpg'
        },
        {
            name: 'Full Name8',
            comment: 'Comment of user8',
            photo: 'path/to/photo8.jpg'
        },
        {
            name: 'Full Name9',
            comment: 'Comment of user9',
            photo: 'path/to/photo9.jpg'
        }
        ];
    } else if (page === 4) {
        comments = [{
            name: 'Full Name10',
            comment: 'Comment of user10',
            photo: 'path/to/photo10.jpg'
        },
        {
            name: 'Full Name11',
            comment: 'Comment of user11',
            photo: 'path/to/photo11.jpg'
        },
        {
            name: 'Full Name12',
            comment: 'Comment of user12',
            photo: 'path/to/photo12.jpg'
        }
        ];
    }

    comments.forEach(comment => {
        const commentRow = document.createElement('div');
        commentRow.className = 'area3-mid-rows';

        const imgDiv = document.createElement('div');
        imgDiv.className = 'area3-mid-rows-cl1';
        const img = document.createElement('img');
        img.src = comment.photo;
        imgDiv.appendChild(img);

        const textDiv = document.createElement('div');
        textDiv.className = 'area3-mid-rows-cl2';
        const h1 = document.createElement('h1');
        h1.textContent = comment.name;
        const p = document.createElement('p');
        p.textContent = comment.comment;
        textDiv.appendChild(h1);
        textDiv.appendChild(p);

        commentRow.appendChild(imgDiv);
        commentRow.appendChild(textDiv);

        commentsContainer.appendChild(commentRow);
    });
}

function showPreviousPage() {
    if (currentPage > 1) {
        currentPage--;
        showComments(currentPage);
    }
}

function showNextPage() {
    if (currentPage < totalPages) {
        currentPage++;
        showComments(currentPage);
    }
}


let currentPublication = 0;
let publications = [];

document.addEventListener("DOMContentLoaded", function () {
    fetchPublications();
});

function fetchPublications() {
    $.ajax({
        url: "actions/get_messages.php?action=get_publications",
        type: "GET",
        dataType: "json",
        success: function (data) {
            publications = data;
            if (publications.length > 0) {
                showPublication(currentPublication);
            } else {
                console.error("No publications found");
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.error('Error fetching publications: ' + errorThrown);
        }
    });
}

function showPublication(index) {
    const photoElement = document.getElementById('publication-photo');
    const textElement = document.getElementById('publication-text');

    if (publications[index]) {
        photoElement.src = 'data:image/jpeg;base64,' + publications[index].photo;
        textElement.textContent = publications[index].text;
    }
}

function showPreviousPublication() {
    if (currentPublication > 0) {
        currentPublication--;
        showPublication(currentPublication);
    }
}

function showNextPublication() {
    if (currentPublication < publications.length - 1) {
        currentPublication++;
        showPublication(currentPublication);
    }
}


// INSERT INTO Meetings (organizer_id, title, description, date_time, duration, location, language_to_practice, proficiency_level)
// VALUES (11, 'New Language Exchange Meeting', 'Let\'s meet and practice our language skills!', '2024-06-15 10:00:00', 120, 'Kyiv, Ukraine', 'English', 'Intermediate');

// -- Получение ID последней вставленной встречи
// SET @meeting_id = LAST_INSERT_ID();

// -- Вставка участников встречи в таблицу Participants
// INSERT INTO Participants (user_id, meeting_id, confirmed)
// VALUES (9, @meeting_id), (10, @meeting_id), (10, @meeting_id, 0);