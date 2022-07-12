<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="google" content="notranslate" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CMM</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" ></script>

    <!-- Datatables -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.bootstrap5.min.css') }}"/>


    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>



    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light sm-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Home
                    
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @can('modelos.create')
                        <li class="nav-item">
                              <a class="nav-link" href={{route('modelos.create')}}> Registrar</a> 
                        </li>
                        @endcan

                        @can('modelos.create')
                        <li class="nav-item">
                              <a class="nav-link" href={{route('modelos.index')}}> Renovar</a> 
                        </li>
                        @endcan
                        @can('modelos.create')
                        <li class="nav-item">
                              <a class="nav-link" href={{route('modelos.tarifa')}}> Tarifas</a> 
                        </li>
                        @endcan

                        @can('empleado.index')
                        <li class="nav-item">
                              <a class="nav-link" href={{route('empleado.index')}}> Ingreso</a> 
                        </li>
                        @endcan

                        @can('empleado.index')
                        <li class="nav-item">
                              <a class="nav-link" href={{route('empleado.perfil')}}> Perfil</a> 
                        </li>
                        @endcan

                        @can('empleado.index')
                        <li class="nav-item">
                              <a class="nav-link" href={{route('empleado.ingreso')}}> Empleados</a> 
                        </li>
                        @endcan

                    </ul>

                    <!-- Right Side Of Navbar -->
                    
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @can('modelos.create')
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">Listar empleados </a>
                                        <a class="dropdown-item" href="{{ route('admin.create') }}"> Registrar empleado</a>
                                    @endcan
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>



        

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
</body>
</html>
