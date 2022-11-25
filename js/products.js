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
    const container = document.getElementById('prodotti');
    //Inserisco i prodotto del db in una tabella html
    for(prodotto of prodotti){
        //Nuova riga
        const riga = document.createElement('tr');
        container.appendChild(riga);
        //Nuove colonne
        const name = document.createElement('td');

        name.textContent = prodotto.nome;

        riga.appendChild(name);

        //Eventi per ogni riga
        name.addEventListener('click', cercaProdotto);
        name.addEventListener('click', cercaImgProdotto);
    }
}

function cercaProdotto(event){
    const nome = event.currentTarget;
    console.log('Cerco '+nome.textContent);
    fetch(BASE_URL + 'products/' + nome.textContent).then(responseNutrizionali).then(onValoriNutrizionali);
}

function responseNutrizionali(response){
    return response.json();
}

function onValoriNutrizionali(valori){
    const container = document.getElementById('valori');
    container.innerHTML = '';
    console.log(valori);
    console.log(valori.hints.length);
    if(valori.hints.length==0){
        container.innerHTML = 'Valori non disponibili';
    }else{
        console.log(valori.hints[0].food.nutrients);
        const kcal = document.createElement('p');
        const carboidrati = document.createElement('p');
        const grassi = document.createElement('p');
        const fibre = document.createElement('p');
        const proteine = document.createElement('p');
    
        const prodotto = document.createElement('h5');
        prodotto.textContent = valori.text;
    
        const valoriNutrizionali = valori.hints[0].food.nutrients;
    
        kcal.textContent = 'CALORIE     '+valoriNutrizionali.ENERC_KCAL;
        carboidrati.textContent = 'CARBOIDRATI  '+valoriNutrizionali.CHOCDF;
        grassi.textContent = 'GRASSI    '+valoriNutrizionali.FAT;
        fibre.textContent = 'FIBRE  '+valoriNutrizionali.FIBTG;
        proteine.textContent = 'PROTEINE    '+valoriNutrizionali.PROCNT;
    
        container.appendChild(prodotto);
        container.appendChild(kcal);
        container.appendChild(carboidrati);
        container.appendChild(grassi);
        container.appendChild(fibre);
        container.appendChild(proteine);
    }


}

//Img----------------
function cercaImgProdotto(event){
    const nome = event.currentTarget;
    console.log('Cerco Img '+nome.textContent);
    fetch(BASE_URL + 'products/img/' + nome.textContent).then(responseImg).then(onImg);
}

function responseImg(response){
    return response.json();
}

function onImg(json){
    console.log(json);
    console.log(json.response.images[0].image.url);
    const img = document.createElement('img');
    const div = document.getElementById('immagine');
    div.innerHTML = '';
    img.src = json.response.images[0].image.url;
    div.appendChild(img);
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

const menu = document.getElementById('menuPiccolo');
let click = true;
menu.addEventListener('click', tenda);