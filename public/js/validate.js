const form = document.querySelector('form')
const error = document.querySelector('#error-text')
form.addEventListener('submit', (e)=>{
    const passInput = document.querySelector('#password');
    const confirmPass = document.querySelector('#confirm_password');

    if(passInput.value !== confirmPass.value){
        e.preventDefault()
        error.style.display = 'block'
        passInput.style.borderColor = 'red';
        confirmPass.style.borderColor = 'red';
    } else {
        error.style.display = 'none'
        passInput.style.borderColor = '';
        confirmPass.style.borderColor = '';
    }
})