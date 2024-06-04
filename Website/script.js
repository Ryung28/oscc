const loginForm = document.querySelector('.login-form');
const signUpForm = document.querySelector('.sign-up-form');

function showSignUp() {
    loginForm.style.display = 'none';
    signUpForm.style.display = '';
}

function showLogin() {
    signUpForm.style.display = 'none';
    loginForm.style.display = '';
}