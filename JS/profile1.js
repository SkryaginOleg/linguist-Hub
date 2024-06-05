let userData = {};

document.addEventListener('DOMContentLoaded', function () {

    loadUser(pageFilling);
    loadFriends(pageFilling);
    seeMeetings();

    const buttons = document.querySelectorAll('.area2-part2-row1 button');
    const modals = document.querySelectorAll('.modal');




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

});




// Витяг всіх даних про користувача
function loadUser(callback) {
    $.ajax({
        url: "actions/get_messages.php?action=get_user&other_user=1",
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
        url: "actions/get_messages.php?action=get_friends&other_user=1",
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



//Функція перегляду усіх зустрічей (Одобрення/Відхилення)
function seeMeetings() {
    $.ajax({
        url: 'actions/get_messages.php?action=get_meetings&other_user=1',
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
                            </div>
                        </div>
                    </div>
                `);

                    meetupList.append(meetupCard);

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
        url: "actions/get_messages.php?action=get_publications&other_user=1",
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
