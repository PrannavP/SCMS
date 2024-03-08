const managerEmailField = document.getElementById('memail');
const mangaerPasswordField = document.getElementById('mpsw');

const emailValidationRegex = /@tvs\.com\.np$/;

const emailError = document.getElementById('email-error-message');

managerEmailField.addEventListener('focus', function(){
    emailError.textContent = ''; // Clear email error message when email field is active or focused.
});

managerEmailField.addEventListener('blur', function(){
    const email = managerEmailField.value.trim();

    if(email.length > 0 && !emailValidationRegex.test(email)){
        // emailError.textContent = 'Login with manager email'; // Show error message if email does not match the regex pattern
        console.log('error message shown');
    } else {
        emailError.textContent = '';
        console.log('error message hidden');
    }
});