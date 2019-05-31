<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Magaly') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Magaly
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      <!-- USer ADM -->
                        @if (Auth::guard()->check() && Auth::user()->is_adm)
                                <div class="dropdown">
                                    <button class="dropbtn">Fornecedor</button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/fornecedor/cadastrar')}}">
                                            Novo Fornecedor
                                        </a>
                                        <a class="dropdown-item" href="{{route('/fornecedor/listar')}}">
                                            Listar Fornecedores
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn">Contrato</button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/contrato/telaCadastrar')}}">
                                            Novo Contrato
                                        </a>
                                        <a class="dropdown-item" href="{{route('/contrato/listar')}}">
                                            Listar Contratos
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn">Escola</button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/escola/cadastrar')}}">
                                            Nova Escola
                                        </a>
                                        <a class="dropdown-item" href="{{route('/escola/listar')}}">
                                            Listar Escolas
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn">Distribuição</button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/distribuicao/telaCadastrar')}}">
                                            Nova Distribuição
                                        </a>
                                        <a class="dropdown-item" href="{{route('/distribuicao/listar')}}">
                                            Listar Distribuições
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn">Item</button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/item/telaCadastrar')}}">
                                            Novo Item
                                        </a>
                                        <a class="dropdown-item" href="{{route('/item/listar')}}">
                                            Listar Itens
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn">Estoque</button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/estoque/cadastrar')}}">
                                            Novo Estoque
                                        </a>
                                        <a class="dropdown-item" href="{{route('/estoque/listar')}}">
                                            Listar Estoque
                                        </a>
                                    </div>
                                </div>
                      @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
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
