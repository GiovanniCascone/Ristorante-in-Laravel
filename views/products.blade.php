@extends('layout')

@section('head')
@parent
    <title>PRODOTTI</title>
<!--creare css specifico-->
    <link rel="stylesheet" href="{{ url('css/stile_products.css') }}?ts=<?=time()?>&quot">
    <script src="{{ url('js/products.js') }}" defer></script>
@endsection

@section('content')
    <header>
        <div id='intestazione'>
            <h3>
                {{ $username }}<br>
                Scopri i valori nutrizionali<br> 
                dei <br>nostri prodotti
            </h3>
        </div>
        
        <div id='sfondo'>
            <img src="{{ url('img/sfondoProdotti.jpg') }}">
        </div>
    </header>

    <div id='spartiacque'></div>

    <article>

    <table id='prodotti'>
        <tr><td><h4>PRODOTTI</h4></td></tr>
    </table>

    <div id='tab'>
        <h4>VALORI NUTRIZIONALI</h4>
        <div id='valori'>
        </div>

        <div id='immagine'>
        </div>
    </div>

    </article>
@endsection
