<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Inventario Invertec', 'INVENTARIO INVERTEC') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/estilos.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .logito{
            width: 5%;
            height: 10%;
            margin: 0 auto;
        }

        .centrar{
            text-align: center;
            float: center;
        }

        #btn-borrar-producto {
            position: absolute;
            right: 20px; /* Cambia este valor según la distancia que desees del borde derecho */
            top: 50%; /* Ajusta la posición vertical si es necesario */
            transform: translateY(-50%);
        }

        .custom-alert {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body >
    <div id="app" >

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container" >
                <div class="logito">
                    <a href="{{ url('/welcome') }}">
                    <img src='/images/logo.png' alt='logo.png' style="height:40px; text-align:center" >
                    </a>
                </div>
                <a class="navbar-brand" href="{{ url('/home') }}">
                    INVENTARIO INVERTEC
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    @if (Auth::check())
   
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto" style="">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('INGRESAR'))
                                <li class="nav-item" >
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('INGRESAR') }}</a>
                                </li>
                            @endif

                            @if (Route::has('REGISTRARSE'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('REGISTRARSE') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown" style="font-size: 110%">
                                <a style="text-transform: uppercase" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('CERRAR SESION') }}
                                        {{--return view('/welcome')--}}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
        <main class="d-flex flex-nowrap responsive" style="height:1480px; ">
        @if (Auth::check())
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark responsive" style="width: 21%; height:100%;" >
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">DATA CENTER</span>
            </a>
            <hr>
            <ul id="colorbase2" class="nav nav-pills flex-column mb-auto" style="hover">
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link text-white" name="colorbase" style="font-size:120%; margin-bottom:5%" aria-current="page">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Home
                </a>
            </li>
            <li>
                <a href="{{ route('movimientos.index') }}" class="nav-link text-white" style="font-size:120%; margin-bottom:5%">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                Historial de Acciones
                </a>
            </li>

            <li>
                <a href="{{ route('productos.index') }}" class="nav-link text-white" style="font-size:120%; margin-bottom:5%">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                Productos
                </a>
            </li>
            <hr>
            <li>
                <a href="{{ route('categorias.index') }}" class="nav-link text-white" style="font-size:120%; margin-bottom:5%">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Categorias
                </a>
            </li>
            <li>
                <a href="{{ route('marcas.index') }}" class="nav-link text-white" style="font-size:120%; margin-bottom:5%">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Marcas
                </a>
            </li>
            <li>
                <a href="{{ route('modelos.index') }}" class="nav-link text-white" style="font-size:120%; margin-bottom:5%">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Modelos
                </a>
            </li>
            </ul>
            <hr>
        </div>
        @endif
            @yield('content')
        </main>
       
</body>
</html>

