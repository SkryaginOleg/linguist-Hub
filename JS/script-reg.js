const signInBtn = document.querySelector('.signin-btn');
const signUpBtn = document.querySelector('.signup-btn');
const formBox = document.querySelector('.form-box');
const body = document.body;


signUpBtn.addEventListener('click', function () {
   formBox.classList.add('active');
   body.classList.add('active');
});

signInBtn.addEventListener('click', function () {
   formBox.classList.remove('active');
   body.classList.remove('active');
});

function removeError(form, input) {
   var input = document.forms[form][input];
   input.classList.remove("error");
   var errorMessage = input.parentNode.querySelector(".error-message");
   if (errorMessage) {
      errorMessage.parentNode.removeChild(errorMessage);
   }
}