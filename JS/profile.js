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


    let isEditProfileModalOpen = false;
    let isCreateMeetingModalOpen = false;

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
                    console.error('Ошибка: ' + response.message);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.error('Ошибка: ' + errorThrown);
            }
        });
    });

    //Закритя сторінки Еdit Profile
    cancelEditButton.addEventListener('click', function () {
        editProfileModal.style.display = 'none';
        document.body.classList.remove('no-scroll');
        isEditProfileModalOpen = false;
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
    $(document).ready(function() {
        function autoExpandTextarea(field) {
            field.style.height = 'auto';
            field.style.height = (field.scrollHeight) + 'px';
        }

        $('#description').on('input', function() {
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

        $('#friendsSearch, #friendsFilter').on('input change', function() {
            filterFriends();
        });

        $.ajax({
            url: 'actions/get_friends.php?action=get_friends',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                friends = response;
                displayFriends(friends);

                let countries = [...new Set(friends.map(friend => friend.country))].sort();
                let friendsFilter = $('#friendsFilter');
                countries.forEach(country => {
                    friendsFilter.append(new Option(country, country));
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching friends:', error);
            }
        });

        $('#createMeetingForm').on('submit', function(event) {
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
            $('input[name="friends"]:checked').each(function() {
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
                success: function(response) {
                    alert('Meeting created successfully!');
                    window.location.reload();
                },
                error: function(xhr, status, error) {
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
                        <button></button>
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


    // Заміна фото
    document.getElementById('changePhotoButton').addEventListener('click', function () {
        var selectedImageFile = document.getElementById('fileInput').files[0];

        if (!selectedImageFile) {
            console.error('Файл не выбран');
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
                    console.error('Ошибка: ' + response.message);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.error('Ошибка: ' + errorThrown);
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
                    console.error('Ошибка: ' + response.message);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.error('Ошибка: ' + errorThrown);
            }
        });
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
































// let currentPage = 1;
// const totalPages = 4;

// document.addEventListener("DOMContentLoaded", function () {
//     showComments(currentPage);
// });

// function showComments(page) {
//     const commentsContainer = document.getElementById('comments-container');
//     commentsContainer.innerHTML = '';

//     let comments = [];

//     if (page === 1) {
//         // comments = [{
//         //         name: 'Full Name1',
//         //         comment: 'Comment of user1',
//         //         photo: 'path/to/photo1.jpg'
//         //     },
//         //     {
//         //         name: 'Full Name2',
//         //         comment: 'Comment of user2',
//         //         photo: 'path/to/photo2.jpg'
//         //     },
//         //     {
//         //         name: 'Full Name3',
//         //         comment: 'Comment of user3',
//         //         photo: 'path/to/photo3.jpg'
//         //     }
//         // ];
//     } else if (page === 2) {
//         comments = [{
//             name: 'Full Name4',
//             comment: 'Comment of user4',
//             photo: 'path/to/photo4.jpg'
//         },
//         {
//             name: 'Full Name5',
//             comment: 'Comment of user5',
//             photo: 'path/to/photo5.jpg'
//         },
//         {
//             name: 'Full Name6',
//             comment: 'Comment of user6',
//             photo: 'path/to/photo6.jpg'
//         }
//         ];
//     } else if (page === 3) {
//         comments = [{
//             name: 'Full Name7',
//             comment: 'Comment of user7',
//             photo: 'path/to/photo7.jpg'
//         },
//         {
//             name: 'Full Name8',
//             comment: 'Comment of user8',
//             photo: 'path/to/photo8.jpg'
//         },
//         {
//             name: 'Full Name9',
//             comment: 'Comment of user9',
//             photo: 'path/to/photo9.jpg'
//         }
//         ];
//     } else if (page === 4) {
//         comments = [{
//             name: 'Full Name10',
//             comment: 'Comment of user10',
//             photo: 'path/to/photo10.jpg'
//         },
//         {
//             name: 'Full Name11',
//             comment: 'Comment of user11',
//             photo: 'path/to/photo11.jpg'
//         },
//         {
//             name: 'Full Name12',
//             comment: 'Comment of user12',
//             photo: 'path/to/photo12.jpg'
//         }
//         ];
//     }

//     comments.forEach(comment => {
//         const commentRow = document.createElement('div');
//         commentRow.className = 'area3-mid-rows';

//         const imgDiv = document.createElement('div');
//         imgDiv.className = 'area3-mid-rows-cl1';
//         const img = document.createElement('img');
//         img.src = comment.photo;
//         imgDiv.appendChild(img);

//         const textDiv = document.createElement('div');
//         textDiv.className = 'area3-mid-rows-cl2';
//         const h1 = document.createElement('h1');
//         h1.textContent = comment.name;
//         const p = document.createElement('p');
//         p.textContent = comment.comment;
//         textDiv.appendChild(h1);
//         textDiv.appendChild(p);

//         commentRow.appendChild(imgDiv);
//         commentRow.appendChild(textDiv);

//         commentsContainer.appendChild(commentRow);
//     });
// }

// function showPreviousPage() {
//     if (currentPage > 1) {
//         currentPage--;
//         showComments(currentPage);
//     }
// }

// function showNextPage() {
//     if (currentPage < totalPages) {
//         currentPage++;
//         showComments(currentPage);
//     }
// }

let currentPublication = 0;
const publications = [{
    photo: 'data:image/jpeg;base64,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',
    text: 'This is the first publication. It describes the first event.'
},
{
    photo: 'data:image/jpeg;base64,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',
    text: 'This is the second publication. It describes the second event.'
},
{
    photo: 'path/to/photo3.jpg',
    text: 'This is the third publication. It describes the third event.'
}
];

document.addEventListener("DOMContentLoaded", function () {
    showPublication(currentPublication);
});

function showPublication(index) {
    const photoElement = document.getElementById('publication-photo');
    const textElement = document.getElementById('publication-text');

    photoElement.src = publications[index].photo;
    textElement.textContent = publications[index].text;
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