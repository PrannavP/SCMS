const phonenumberField = document.getElementById('pnumber');
const emailField = document.getElementById('email');
const passwordField = document.getElementById('psw');
const confirmPasswordField = document.getElementById('cpsw');
const registerButton = document.getElementById('customer-register');

function formValidation(){
    let phonenumber = phonenumberField.value;
    let email = emailField.value;
    let password = passwordField.value;
    let confirmPassword = confirmPasswordField.value;

    // error message elements
    let errorMessageElement = document.querySelector('.error-messages');
    let phonenumberErrorElement = document.querySelector('.phonenumber-error-message');
    let emailErrorElement = document.querySelector('.email-error-message');
    let passwordErrorElement = document.querySelector('.password-error-message');

    // set the display to none of the elements
    errorMessageElement.style.display = "none";
    phonenumberErrorElement.style.display = "none";
    emailErrorElement.style.display = "none";
    passwordErrorElement.style.display = "none";

    // logic

    if(phonenumber.length < 10){
        errorMessageElement.style.display = "block";
        phonenumberErrorElement.style.display = "block";
    }
};

formValidation();