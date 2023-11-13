<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>INVENTARIO INVERTEC</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <!-- Styles -->
        <style>

            .centered-links {
                display: flex;
                flex-direction: column;
                align-items: center; /* Centra los elementos verticalmente */
            }

            a{
                font-family: Arial, sans-serif;
                font-weight: normal;
                text-decoration: none;
                margin-bottom: 80px;
            }

            .boton {
                display: inline-block;
                padding: 2% 6%; /* Ajusta el relleno (padding) según tus necesidades */
                background-color: green; /* Color de fondo del botón */
                color: #fff; /* Color del texto */
                border: none; /* Borde del botón (puedes personalizarlo) */
                border-radius: 5px; /* Bordes redondeados */
                text-align: center;
                text-decoration: none;
                font-size: auto; /* Tamaño de fuente */
                cursor: pointer; /* Cambia el cursor al pasar el mouse */
            }

            .caja{
                text-align: center; 
                margin-top: 5%;
            }

            .ula{
                text-align: center; 
                margin-bottom: 16%;
            }

            .caja2{
                text-align: center; 
                background-color: white;
                padding bottom: 25%;
                margin-left: 25%; 
                margin-right: 25%;
                margin-top: 8%;
                border-radius: 5%;
            }

            body{
                background-color: #212529;
            }

            .foto{
                width: 43%;
                height: 38%;
                text-align: center;
            }

            .boton2 {
                display: inline-block;
                padding: 2% 4%; /* Ajusta el relleno (padding) según tus necesidades */
                background-color: green; /* Color de fondo del botón */
                color: #fff; /* Color del texto */
                border: none; /* Borde del botón (puedes personalizarlo) */
                border-radius: 5px; /* Bordes redondeados */
                text-align: center;
                text-decoration: none;
                font-size: 16px; /* Tamaño de fuente */
                cursor: pointer; /* Cambia el cursor al pasar el mouse */
            }

            .btninventario{
                display: inline-block;
                padding: 2.5% 4%; /* Ajusta el relleno (padding) según tus necesidades */
                background-color: green; /* Color de fondo del botón */
                color: #fff; /* Color del texto */
                border: none; /* Borde del botón (puedes personalizarlo) */
                border-radius: 5px; /* Bordes redondeados */
                text-align: center;
                text-decoration: none;
                font-size: auto; /* Tamaño de fuente */
                cursor: pointer; 
            }

        </style>
    </head>
    <body class="antialiased">
        <div class="caja2">
            @if (Route::has('login'))
                <div class="container caja">
                        <img src='./images/logo2.png' alt='foto principal' style="max-width: 45.4rem;">
                    @auth
                    <div class="ula">
                        <a href="{{ url('/home') }}" class="btninventario">IR AL INVENTARIO</a>
                    </div>
                    @else
                    <div class="ula">
                        <a href="{{ route('login') }}" class="boton" style="margin-right:15px; font-size:100%">INGRESAR</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="boton2" style="margin-left:15px; font-size:100%">REGISTRARSE</a>
                        @endif
                    </div>
                    @endauth

            @endif

        </div>
    </body>
</html>
