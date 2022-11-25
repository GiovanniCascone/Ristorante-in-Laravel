<html>

<head>
    <title> LOGIN </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('css/commonLogSign.css') }}?ts=<?=time()?>&quot">
    <script src="{{ url('js/login.js') }}" defer></script>
</head>

<body>
    <h1 id='titolo'>LOGIN</h1>
    <main>
        <form name='login' method='post'>
            @csrf

            @if($error == 'empty_fields')
            <div>Compilare tutti i campi</div>
            @elseif($error == 'wrong')
            <div>Utente o Password errati</div>
            @endif

            <label>Username<input type="text" name="username" value='{{ old("username") }}'></label>
            <div data-input='username' class=hidden>Username mancante</div>

            <label>Password<input type="Password" name="password"></label>
            <div data-input='password' class=hidden>Password mancante</div>

            <div id='accedi'>
                <input id='submit' type="submit" name="submit" value="Accedi">
                <div id='oppure'>oppure</div>
                <div><a href="{{ url('register') }}">Iscriviti</a></div>
            </div>
        </form>
    </main>

    <footer>
        <h4>Contatti</h4>
        <div>Telefono: 333 333 3333</div>
        <div>Indirizzo: Riviera Lanterna, Scoglitti(RG)</div>
    </footer>

</body>



</html>