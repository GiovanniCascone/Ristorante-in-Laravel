<html>
    <head>
    @section('head')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Dopo il file css inserisco un comando che mi permette 
    di aggiornare le modifiche css, altrimenti non visibili-->
    <link rel="stylesheet" href="{{ url('css/common.css') }}?ts=<?=time()?>&quot">
    <!--Stili Font -->

    <script>
        const BASE_URL = "{{ URL('/') }}/";
    </script>
    @show
    </head>

<body>
    <nav id='menuNormale'> 
        <div id=logo>  
            <h1>MERCATO ITTICO</h1>
            <h2>RISTORANTE DI PESCE</h2>
        </div>
        <div><a href="{{ url('home') }}"> HOME </a></div>
        <div><a href="{{ url('products') }}"> PRODOTTI </a></div>
        <div><a href="{{ url('menu') }}"> MENU' </a></div>
        <div><a href="{{ url('logout') }}"> Log out </a></div>
    </nav>

    <div id='menuPiccolo' class='hidden'> 
        <div id=logo>  
            <h1>MERCATO ITTICO</h1>
            <h2>RISTORANTE DI PESCE</h2>
        </div>
        <div id='tendina' class='hidden'>
            <div><a href="{{ url('home') }}"> HOME </a></div>
            <div><a href="{{ url('products') }}"> PRODOTTI </a></div>
            <div><a href="{{ url('menu') }}"> MENU' </a></div>
            <div><a href="{{ url('logout') }}"> Log out </a></div>
        </div>
    </div>
    

    @yield('content')
    
    <footer>
        <h4>Contatti</h4>
        <div>Telefono: 333 333 3333</div>
        <div>Indirizzo: Riviera Lanterna, Scoglitti(RG)</div>
    </footer>
</body>

</html>