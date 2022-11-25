//Carico dal db tutti i prodotti ordinabili

fetch(BASE_URL + 'home/product').then(responseAggiorna).then(onRiempiMenu);

function responseAggiorna(response)
{
    return response.json();
}

function onRiempiMenu(json)
{
    const prodotti = json;
    console.log('Leggo i prodotti dal database');
    const container = document.getElementById('menu');
    //Inserisco i prodotto del db in una tabella html
    for(prodotto of prodotti){
        //Nuova riga
        const riga = document.createElement('tr');
        container.appendChild(riga);
        //Nuove colonne
        const id = document.createElement('td');
        const name = document.createElement('td');
        const price = document.createElement('td');
        const quantity = document.createElement('td');
        const buy = document.createElement('td');
        const compra = document.createElement('img');
        compra.src =  BASE_URL + 'img/buy.png';
        compra.className = 'pulsanti';
        buy.appendChild(compra);
        //Creo elemento input
        const number = document.createElement('input');
        number.disabled;
        number.type = 'number';
        number.min = '1';
        number.max = '20';
        number.defaultValue = '1';
        quantity.appendChild(number);

        id.textContent = prodotto.id;
        name.textContent = prodotto.nome;
        price.textContent = prodotto.prezzo;

        riga.appendChild(id);
        riga.appendChild(name);
        riga.appendChild(price);
        riga.appendChild(quantity);
        riga.appendChild(buy);

        //Eventi per ogni riga
        buy.addEventListener('click', cercaProdotto);
        number.addEventListener('blur', controllaNumero);
        
    }

}


//--------------------------------
//Limite numero di prodotti selezionabili
function controllaNumero(event){
    const number = event.currentTarget;
    const err = document.getElementById('errQuantity');
    if(number.value<1){
        number.value=1;
        err.classList.remove("hidden");
    }else if(number.value>20){
        number.value=20;
        err.classList.remove("hidden");
    }
}
//--------------------------------
function cercaProdotto(event)
{
    const buy = event.currentTarget;
    const riga = buy.parentNode;
    buy.removeEventListener('click', cercaProdotto);
    const id = riga.querySelector('td');
    const quantità = riga.querySelector('input');
    console.log('Aggiungi prodotto '+id.textContent+' quantità '+quantità.value);

    


    fetch(BASE_URL + 'productById/' + id.textContent +'/'+ quantità.value).then(onProductResponse).then(onAggiungiAlCarrello);

}

//Aggiungo(solo graficamente) al carrello l'elemento selezionato
function onProductResponse(response)
{
    return response.json();
}

function onAggiungiAlCarrello(prodotto)
{
    console.log('Aggiungi al carrello');
    const container = document.getElementById('carrello');
    //Inserisco i prodotto del db in una tabella html
    //Nuova riga
    const riga = document.createElement('tr');
    riga.className = 'prodotto';
    container.appendChild(riga);
    //Nuove colonne
    const id = document.createElement('td');
    id.className = 'id';
    const name = document.createElement('td');
    //----------------
    name.dataset.prodotto = 'nome';
    //----------------
    const price = document.createElement('td');
    //----------------
    price.dataset.prodotto = 'prezzo';
    //----------------
    const quantity = document.createElement('td');
    //----------------
    quantity.dataset.prodotto = 'quantità';
    //----------------
    const remove = document.createElement('td');
    const chiudi = document.createElement('img');
    chiudi.src =  BASE_URL + 'img/x.png';
    chiudi.className = 'pulsanti';
    remove.appendChild(chiudi);

    id.textContent = prodotto[0].id;
    name.textContent = prodotto[0].nome;
    price.textContent = prodotto[0].prezzo;
    quantity.textContent = prodotto[1];

    riga.appendChild(id);
    riga.appendChild(name);
    riga.appendChild(price);
    riga.appendChild(quantity);
    riga.appendChild(remove);

    totale = totale + (prodotto[0].prezzo * quantity.textContent);
    total.value = totale;

    remove.addEventListener('click', eliminaDaCarrello);
        
}
//Eliminazione(grafica) di un elemento dal carrello
function eliminaDaCarrello(event)
{
    console.log('rimozione');
    const elimina = event.currentTarget;
    const riga = elimina.parentNode;
    console.log(riga);
    elimina.removeEventListener('click', cercaProdotto);
    const prezzo = riga.querySelector('[data-prodotto=prezzo]');
    const quantità = riga.querySelector('[data-prodotto=quantità]');
    totale = totale - (prezzo.textContent*quantità.textContent);
    console.log(totale);
    total.value = totale;
    riga.parentNode.removeChild(riga);
}

//Creo carrello in db
function creaCarrello(){
    const tavolo = document.getElementById('tavolo');
    console.log(tavolo.value);
    console.log(total.value);
    const errTav = document.getElementById('errTav');
    const errTot = document.getElementById('errTot');

    if((tavolo.value==='' || isNaN(tavolo.value) || (tavolo.value<1 || tavolo.value>30)) 
        && (total.value ==='' || total.value === '0')){
        errTav.classList.remove('hidden');
        errTot.classList.remove('hidden');
        console.log('Tav: no Tot: no');
    }else if((tavolo.value!=='' && !isNaN(tavolo.value) && (tavolo.value>0 && tavolo.value<31)) 
        && (total.value ==='' || total.value === '0')){
        errTav.classList.add('hidden');
        errTot.classList.remove('hidden');
        console.log('Tav: yes Tot: no');
    }else if((tavolo.value==='' || isNaN(tavolo.value) || (tavolo.value<1 || tavolo.value>30)) 
        && (total.value !=='' || total.value !== '0')){
        errTot.classList.add('hidden');
        errTav.classList.remove('hidden');
        console.log('Tav: no Tot: yes');
    }else{
        console.log('Tav: yes Tot: yes');
        paga.removeEventListener('click', creaCarrello);
        paga.value = 'Ricarica pagina';
        paga.addEventListener('click', ricaricaPagina);
        errTav.classList.add('hidden');
        errTot.classList.add('hidden');
        fetch(BASE_URL + 'creaCarrello/' + totale + '/' + tavolo.value).
        then(onCarrelloResponse).
        then(onCreaOrdine);
    }
}
//Al secondo click su paga ricarica la pagina
function ricaricaPagina(){
    location.reload();
}

function onCarrelloResponse(response)
{
    return response.json();
}

function onCreaOrdine(cart_id)
{   
    const success = document.getElementById('success');
    success.classList.remove('hidden');
    const music = new Audio('img/music.mp3');
    music.play();
    const container = document.getElementById('carrello');
    const righe = container.getElementsByClassName('prodotto');
    console.log('creaOrdine numero '+ cart_id);
    //Scorro le righe del carrello grafico e invio i dati al server
    for(riga of righe){
        console.log(riga);
        const prodotto = riga.querySelector('[data-prodotto=nome]');
        const prezzo = riga.querySelector('[data-prodotto=prezzo]');
        const quantità = riga.querySelector('[data-prodotto=quantità]');
        const form_data = new FormData();
        form_data.append('prodotto', prodotto.textContent);
        form_data.append('prezzo', prezzo.textContent);
        form_data.append('quantità', quantità.textContent);
        form_data.append('_token', csrf_token);
    
        fetch(BASE_URL + 'creaOrdine/' + cart_id,{method: 'post', body: form_data}).
        then(onOrderResponse).
        then(onOrderData);
    }

}

function onOrderResponse(response)
{
    return response.json();
}

function onOrderData(ordine){
    console.log('ciao');
}


//MENU'-----------------------

function tenda(event){
    console.log('menu');
    const tendina = document.getElementById('tendina');
    if(click === true){
        console.log('visibile');
        tendina.classList.remove('hidden');
        click = false;
    }else{
        console.log('invisibile');
        tendina.classList.add('hidden');
        click = true;
    }
}

//---------------------------------
//INIZIALIZZAZIONE
//Variabili
const paga = document.getElementById('paga');
const menu = document.getElementById('menuPiccolo');
let total = document.getElementById('totale');
let totale = 0;
let click = true;


//Eventi
paga.addEventListener('click', creaCarrello);
menu.addEventListener('click', tenda);
