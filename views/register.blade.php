<html>
<head>
    <title>REGISTRAZIONE</TITLE>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ url('js/sign.js') }}" defer></script>
    <link rel="stylesheet" href="{{ url('css/commonLogSign.css') }}?ts=<?=time()?>&quot">
</head>

<body>
    <h1 id='titolo'>ISCRIVITI</h1>      

    <main>
    <form name='register' method='post'>
        @csrf
        <!--Mostro errori mandati dal server-->
        @if($error == 'empty_fields')
        <div>Compilare tutti i campi</div>
        @elseif($error == 'email_error')
        <div>Email non valida</div>
        @elseif($error == 'username_error')
        <div>Username non valido</div>
        @elseif($error == 'existing')
        <div>Username già utilizzato</div>
        @elseif($error == 'password_error')
        <div>Password troppo corta</div>
        @elseif($error == 'privacy_error')
        <div>Acconsenti al trattamento dei dati</div>
        @endif

        <!-- Al ricaricamento della pagina ritrovo i valori dei campi input
            inseriti precedentemente -->
        <label>Nome<input type='text' name='nome' value='{{ old("nome") }}'></label>
        <div class=hidden data-input='nome'>Inserisci il tuo nome</div>

        <label>Cognome<input type='text' name='cognome' value='{{ old("cognome") }}'></label>
        <div class=hidden data-input='cognome'>Inserisci il tuo cognome</div>

        <label>Email<input type='text' name='email' value='{{ old("email") }}'></label>
        <div class=hidden data-input='email'>Inserisci una mail valida</div>

        <label>Username<input type='text' name='username' value='{{ old("usurname") }}'></label>
        <div class=hidden data-input='username'>Da 3 a 15 caratteri o già utilizzato</div>

        <label>Password<input type='password' name='password' value='{{ old("password") }}'></label>
        <div class=hidden data-input='password'>Lunghezza minima 8 caratteri</div>

        <label>Acconsento alla normativa sulla privacy<input id='privacy' type='checkbox' name=privacy[]></label>
        <div class=hidden data-input='privacy'>Consenti</div>
        
        <div id='accedi'>
            <input id="submit" type='submit' name='submit' value='Iscriviti'>
            <div id='oppure'>oppure</div>
            <div><a href="{{ url('login') }}">Login</a></div>
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