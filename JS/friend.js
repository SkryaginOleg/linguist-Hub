document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.custom-button');
    const modals = document.querySelectorAll('.modal');
    const closeButtons = document.querySelectorAll('.close');
    const textField = document.getElementById('text-field');

 
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
}



