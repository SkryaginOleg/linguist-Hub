document.addEventListener('DOMContentLoaded', function () {
    const editProfileButton = document.getElementById('groupSettingsButton');
    const editProfileModal = document.getElementById('groupSettingsModal');
    const closeButton = document.querySelector('.close');
    const okButton = document.querySelector('.cl2-row3 button');
    const xButton = document.querySelector('.cl2-row1-c2 button');

    editProfileButton.addEventListener('click', function () {
        editProfileModal.style.display = 'block';
    });

    // Проверка, что кнопки найдены перед добавлением обработчиков
    if (closeButton) {
        closeButton.addEventListener('click', function () {
            editProfileModal.style.display = 'none';
        });
    }

    if (okButton) {
        okButton.addEventListener('click', function () {
            editProfileModal.style.display = 'none';
        });
    }

    if (xButton) {
        xButton.addEventListener('click', function () {
            editProfileModal.style.display = 'none';
        });
    }


});