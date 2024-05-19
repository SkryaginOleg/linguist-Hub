document.addEventListener('DOMContentLoaded', () => {
    
    const buttons = document.querySelectorAll('.button11, .button21, .button31');

    
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            
            buttons.forEach(btn => btn.classList.remove('active'));

            
            button.classList.add('active');
        });
    });
});


;
