const username = document.forms['login'].username;
const password = document.forms['login'].password;

username.addEventListener('blur', errUser);
password.addEventListener('blur', errPass);

function errUser(event){
    const user = event.currentTarget;
    const err = document.querySelector('[data-input=username]');
    if(user.value.length == 0){
        err.classList.remove('hidden');
    }else{
        err.classList.add('hidden');
    }
}

function errPass(event){
    const pass = event.currentTarget;
    const err = document.querySelector('[data-input=password]');
    if(pass.value.length == 0){
        err.classList.remove('hidden');
    }else{
        err.classList.add('hidden');
    }
}