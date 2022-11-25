//Variabili Globali

const nome = document.forms['register'].nome;
const cognome = document.forms['register'].cognome;
const email = document.forms['register'].email;
const username = document.forms['register'].username;
const password = document.forms['register'].password;
const privacy = document.getElementById('privacy');

const form = document.forms['register'];

let ready = ['no', 'no', 'no', 'no', 'no', 'no'];


//Eventi
nome.addEventListener('blur', checkName);
cognome.addEventListener('blur', checkSurname);
email.addEventListener('blur', checkEmail);
username.addEventListener('blur', checkUsername);
password.addEventListener('blur', checkPassword);
privacy.addEventListener('blur', checkPrivacy);

form.addEventListener('submit', checkForm);


//Funzioni
function checkName(event){
    const err = document.querySelector("[data-input='nome']");
    if(nome.value.length == 0 || !isNaN(nome.value))
        {
            err.classList.remove("hidden");
            ready[0] = "no";
        }else{
            ready[0] = "yes";
            console.log(ready);
            err.classList.add("hidden");
        } 
}

function checkSurname(event){
    const err = document.querySelector("[data-input='cognome']");
    if(cognome.value.length == 0 || !isNaN(cognome.value))
        {
            err.classList.remove("hidden");
            ready[1] = "no";
        }else{
            ready[1] = "yes";
            console.log(ready);
            err.classList.add("hidden");
        } 
}

function checkEmail(event){
    const err = document.querySelector("[data-input='email']");
    if(email.value.length == 0)
        {
            err.classList.remove("hidden");
            ready[2] = "no";
        }else{
            ready[2] = "yes";
            console.log(ready);
            err.classList.add("hidden");
        } 
}

function checkUsername(event){
    const err = document.querySelector("[data-input='username']");
    if(!(username.value.length >= 3 && username.value.length <= 15))
        {
            err.classList.remove("hidden");
            ready[3] = "no";
        }else{
            ready[3] = "yes";
            console.log(ready);
            err.classList.add("hidden");
        } 
}

function checkPassword(event){
    const err = document.querySelector("[data-input='password']");
    if(password.value.length < 8)
        {
            err.classList.remove("hidden");
            ready[4] = "no";
        }else{
            ready[4] = "yes";
            console.log(ready);
            err.classList.add("hidden");
        } 
}

function checkPrivacy(event){
    const err = document.querySelector("[data-input='privacy']");
    if(!privacy.checked)
        {
            err.classList.remove("hidden");
            ready[5] = "no";
        }else{
            ready[5] = "yes";
            console.log(ready);
            err.classList.add("hidden");
        } 
}

function checkForm(event){
    let pronto = 0;
    checkName();
    checkSurname();
    checkEmail();
    checkUsername();
    checkPassword();
    checkPrivacy();
    for(let i=0; i<6; i++){
        if(ready[i] === "yes")
            pronto += 1;
            console.log(pronto);
    }
    if(pronto !== 6){
        event.preventDefault();
        alert('Inserisci tutti i campi in modo corretto');
    }
}