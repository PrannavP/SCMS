const passwordField = document.getElementById('psw');
const confirmPasswordField = document.getElementById('cpsw');
const registerButton = document.getElementById('customer-register');

let password = passwordField.value;
let confirmPassword = confirmPasswordField.value;

function checkPasswordMatch(psw, cpsw){
    if(psw !== cpsw){
        console.log('Both passwords didnt match!');
        console.log
        alert('Both passwords didnt match!');
    }else{
        console.log('Both passwords matched');
        alert('Both passwords matched!');
    };
};