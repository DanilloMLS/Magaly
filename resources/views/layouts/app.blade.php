<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Magaly</title>
    <link rel="shortcut icon" href="/img/MG-S.png" type="image/x-png">
  <style type="text/css">

  footer {
    height: 60px;
    width: 100%;
    z-index: 1;
    bottom: 0px;
  }
  </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Magaly
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      <!-- USer ADM -->
                        @if (Auth::guard()->check())
                          @if (Auth::user()->is_adm)
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/fornec.png"><div class="titulo-botao">Fornecedor</div></button>
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
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/contra.png"><div class="titulo-botao">Contrato</div></button>
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
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/escol.png"><div class="titulo-botao">Escola</div></button>
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
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/item.png"><div class="titulo-botao">Item</div></button>
                                    <div class="dropdown-content">
                                        <!-- <a class="dropdown-item" href="{{route('/item/telaCadastrar')}}">
                                            Novo Item
                                        </a> -->
                                        <a class="dropdown-item" href="{{route('/item/listar')}}">
                                            Listar Itens
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/estoq.png"><div class="titulo-botao">Estoque</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/estoque/cadastrar')}}">
                                            Novo Estoque
                                        </a>
                                        <a class="dropdown-item" href="{{route('/estoque/listar')}}">
                                            Listar Estoques
                                        </a>

                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/refeic.png"><div class="titulo-botao">Refeição</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/refeicao/cadastrar')}}">
                                            Nova Refeição
                                        </a>
                                        <a class="dropdown-item" href="{{route('/refeicao/listar')}}">
                                            Listar Refeições
                                        </a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/cardap.png"><div class="titulo-botao">Cardápio</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/cardapio/cadastrar')}}">
                                            Novo Cardápio
                                        </a>
                                        <a class="dropdown-item" href="{{route('/cardapio/listar')}}">
                                            Listar Cardápios
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/distri.png"><div class="titulo-botao">Distribuição</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/distribuicao/telaCadastrar')}}">
                                            Nova Distribuição
                                        </a>
                                        <a class="dropdown-item" href="{{route('/distribuicao/listar')}}">
                                            Listar Distribuições
                                        </a>
                                    </div>
                                </div>
                                @else
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/fornec.png"><div class="titulo-botao">Fornecedor</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/fornecedor/listar')}}">
                                  Listar Fornecedores
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/contra.png"><div class="titulo-botao">Contrato</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/contrato/listar')}}">
                                  Listar Contratos
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/escol.png"><div class="titulo-botao">Escola</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/escola/listar')}}">
                                  Listar Escolas
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/distri.png"><div class="titulo-botao">Distribuição</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/distribuicao/listar')}}">
                                  Listar Distribuições
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/item.png"><div class="titulo-botao">Item</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/item/listar')}}">
                                  Listar Itens
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/estoq.png"><div class="titulo-botao">Estoque</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/estoque/listar')}}">
                                  Listar Estoques
                              </a>

                          </div>
                      </div>

                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/refeic.png"><div class="titulo-botao">Refeição</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/refeicao/listar')}}">
                                  Listar Refeições
                              </a>
                          </div>
                      </div>

                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/cardap.png"><div class="titulo-botao">Cardápio</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/cardapio/listar')}}">
                                  Listar Cardápios
                              </a>
                          </div>
                      </div>
                      @endif
                    @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul align="center" class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                        <img class="btn-img" src="/img/exit.png">
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @if (Auth::user()->is_adm)
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img class="btn-img" src="/img/adm.png">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('register') }}">
                                                {{'Novo'}}
                                                <img class="btn-img" src="/img/cadastro.png">
                                            </a>
                                            <a class="dropdown-item" href="{{route('/logActivity')}}">
                                                {{'Logs'}}
                                                <img class="btn-img" src="/img/history.png">
                                            </a>
                                    </div>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="container-fluid text-center" >
      <img class=" logo-garanhuns left" src="/img/logo.png">
    </footer>
    <footer class="container-fluid text-center">

  </footer>

</body>
</html>
