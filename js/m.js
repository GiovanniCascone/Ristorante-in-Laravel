//Carico dal db tutti i prodotti ordinabili

fetch(BASE_URL + 'menu/mostra').then(responseAggiorna).then(onRiempiMenu);

function responseAggiorna(response)
{
    return response.json();
}

function onRiempiMenu(json)
{
    const menus = json;
    console.log('Leggo i prodotti dal database');
    console.log(menus);
    const container = document.getElementById('menu');
    //Inserisco i prodotto del db in una tabella html
    for(menu of menus){
        //Nuova riga
        const riga = document.createElement('tr');
        container.appendChild(riga);
        //Nuove colonne
        const name = document.createElement('td');
        const price = document.createElement('td');
        const descrizione = document.createElement('td');

        name.textContent = menu.nome;
        price.textContent = menu.prezzo;
        descrizione.textContent = menu.descrizione;

        riga.appendChild(name);
        riga.appendChild(price);
        riga.appendChild(descrizione);
        
    }

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

const nav = document.getElementById('menuPiccolo');
let click = true;
nav.addEventListener('click', tenda);