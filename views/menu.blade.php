@extends('layout')

@section('head')
@parent
    <title>HOME</title>
    <link rel="stylesheet" href="{{ url('css/stile_home.css') }}?ts=<?=time()?>&quot">
    <script>
        const csrf_token = '{{ csrf_token() }}';
    </script>
    <script src="{{ url('js/m.js') }}" defer></script>
@endsection

@section('content')
    <header>
        <div id='intestazione'>
            <h3>
                Benvenuto {{ $username }}<br><br>
                Chiedi uno dei nostri menù al cameriere
            </h3>
        </div>

        <div id='sfondo'>
            <img src="{{ url('img/sfondoMenu.jpg') }}">
        </div>
    </header>

    <div id='spartiacque'></div>


    <article>
        <table id='menu'>
        <tr><td>NOME</td><td>PREZZO</td><td>DESCRIZIONE</td></tr>

        </table>
    </article>
@endsection