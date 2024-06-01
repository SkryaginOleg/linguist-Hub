document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.custom-button');
    const modals = document.querySelectorAll('.modal');
    const closeButtons = document.querySelectorAll('.close');
    const textField = document.getElementById('text-field');
    const deleteLinks = document.querySelectorAll('.delete-friend');

    function searchGroups() {
        const groupname = document.getElementById('groupname').value;
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'groupname=' + encodeURIComponent(groupname),
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('results').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    }
 
    function addFriend(idfrom, idadd) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_friend.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
            }
        };
        xhr.send("idfrom=" + idfrom + "&idadd=" + idadd);
    }
    function closeAllModals() {
        modals.forEach(modal => modal.style.display = 'none');
    }

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.getAttribute('data-modal');
            const modal = document.getElementById(modalId);

            if (modal) {
                closeAllModals();
                modal.style.display = 'block';
                textField.textContent = this.textContent.trim();
            }
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const modal = this.closest('.modal');
            modal.style.display = 'none';
        });
    });

    window.addEventListener('click', function (event) {
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    deleteLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const userId = this.getAttribute('data-user-id');
            deleteFriend(userId);
        });
    });

    function deleteFriend(userId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'friend.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const friendElement = document.querySelector(`.m1cr2first1[data-user-id="${userId}"]`);
                if (friendElement) {
                    friendElement.remove();
                }
            }
        };
        xhr.send('action=delete&user_id=' + userId);
    }
});

function toggleDropdown(button) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
            setTimeout(() => {
                openDropdown.style.display = 'none';
            }, 500); 
        }
    }

    var dropdown = button.nextElementSibling;
    if (dropdown.style.display === 'block') {
        dropdown.classList.remove('show');
        setTimeout(() => {
            dropdown.style.display = 'none';
        }, 500); 
    } else {
        dropdown.style.display = 'block';
        setTimeout(() => {
            dropdown.classList.add('show');
        }, 0); 
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
                setTimeout(() => {
                    openDropdown.style.display = 'none';
                }, 500); 
            }
        }
    }
};




