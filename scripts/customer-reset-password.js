const passwordField = document.getElementById('password');
const confirmPasswordField = document.getElementById('c_password');
const resetButton = document.getElementById('reset');
const passwordErrorField = document.querySelector('.password-error-field');

resetButton.disabled = true;

function checkPasswordValue(){
    if(passwordField.value === confirmPasswordField.value){
        resetButton.disabled = false;
        passwordErrorField.style.display = "none";
        console.log(resetButton.disabled);
    }else{
        resetButton.disabled = true;
        passwordErrorField.style.display = "block";
        console.log(resetButton.disabled);
    };
};

passwordField.addEventListener('input', checkPasswordValue);
confirmPasswordField.addEventListener('input', checkPasswordValue);

// checkPasswordValue(passwordField.value, confirmPasswordField.value);