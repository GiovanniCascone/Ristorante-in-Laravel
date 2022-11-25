@extends('layout')

@section('head')
@parent
    <title>HOME</title>
    <link rel="stylesheet" href="{{ url('css/stile_home.css') }}?ts=<?=time()?>&quot">
    <script>
        const csrf_token = '{{ csrf_token() }}';
    </script>
    <script src="{{ url('js/home.js') }}" defer></script>
@endsection

@section('content')
    <header>
        <div id='intestazione'>
            <h3>
                Benvenuto {{ $username }}<br><br>
                Ordina
            </h3>
        </div>

        <div id='sfondo'>
            <img src="{{ url('img/sfondoHome.jpg') }}">
        </div>
    </header>

    <div id='spartiacque'></div>

    <div id='success' class='hidden'>
        Ordine effettuato con successo
    </div>

    <article>
        <table id='menu'>
        <tr><td>CODICE</td><td>NOME</td><td>PREZZO</td><td>QUANTITÀ</td><td>ACQUISTA</td><td></td></tr>
        <tr><td></td><td></td><td></td><td id='errQuantity' class='hidden'>Quantità minima 1 - massima 20</td><td></td></tr>

        </table>
        <table id='carrello'>
        <tr><td>TAVOLO</td><td><input id='tavolo' type='text' name='tavolo'></td><td>TOTALE</td><td><input id='totale' type='text' name='totale' readonly></td><td><input id='paga' type='button' name='button' value='Ordina'></td></tr>
        <tr><td></td><td id='errTav' class='hidden'>Inserire numero tavolo(da 1 a 30)</td><td></td><td id='errTot' class='hidden'>aggiungere almeno un prodotto</td><td></td></tr>
        <tr><td>CODICE</td><td>NOME</td><td>PREZZO</td><td>QUANTITÀ</td><td>RIMUOVI</td></tr>
        </table>
    </article>
@endsection