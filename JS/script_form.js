function checkSignUpForm() {
  var loginInput = document.forms["signupForm"]["login"];
  var emailInput = document.forms["signupForm"]["email"];
  var passwordInput = document.forms["signupForm"]["password"];
  var repasswordInput = document.forms["signupForm"]["repassword"];

  var correctForm = validateForm(loginInput, "login") && validateForm(emailInput, "email") && validateForm(passwordInput, "password");

  if (!correctForm) {
    return false;
  }
  else if (passwordInput.value !== repasswordInput.value) {
    var message = "Паролі не співпадають.";
    addError(repasswordInput, message);
    return false;
  }
  else {
    return true;
  }
}

function checkSignInForm() {
  var loginInput = document.forms["signinForm"]["login"];
  var passwordInput = document.forms["signinForm"]["password"];

  return validateForm(loginInput, "login") && validateForm(passwordInput, "password");
}



function validateForm(inputFieleds, type) {
  if (inputFieleds.value.trim() === "") {
    var message;

    switch (type) {
      case "login":
        message = "Введіть логін";
        break;
      case "email":
        message = "Введіть email";
        break;
      case "password":
        message = "Введіть пароль";
        break;
    }
    addError(inputFieleds, message)

    return false;
  }
  return true;
}

function addError(inputFieleds, message) {
  if (!inputFieleds.classList.contains("error")) {
    inputFieleds.classList.add("error");
    var errorMessage = document.createElement("div");
    errorMessage.className = "error-message";
    errorMessage.textContent = message;
    inputFieleds.parentNode.appendChild(errorMessage);
  }
}

document.addEventListener('DOMContentLoaded', function () {

  document.getElementById('signupForm').addEventListener('submit', function (event) {
    event.preventDefault();

    if (!checkSignUpForm()) {
      return;
    }

    var login = document.forms["signupForm"]["login"].value;
    var email = document.forms["signupForm"]["email"].value;
    var password = document.forms["signupForm"]["password"].value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'checkAuthentication.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          if (!xhr.responseText) {
            console.error("xhr.responseText = error");
          }
          else {
            var response = JSON.parse(xhr.responseText);
            if (response.result == 'error') {
              var emailInput = document.forms["signupForm"]["email"];
              addError(emailInput, "На цій почті вже створено обліковий запис.");
            }
            else if (response.result == 'success') {
              alert("YES");
            }
          }
        }
        else {
          console.error('AJAX Error:', xhr.statusText);
        }
      }
    };
    xhr.send('login=' + login + '&email=' + email + '&password=' + password + '&registration=true');
  });
});
