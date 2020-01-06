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
                                            Adicionar Fornecedor
                                        </a>
                                        <a class="dropdown-item" href="{{route('/fornecedor/listar')}}">
                                            Listagem Fornecedores
                                        </a>
                                        <a class="dropdown-item" target="_blank" href="{{ route("/fornecedor/RelatorioFornecedores") }}">
                                            Imprimir Fornecedores
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/contra.png"><div class="titulo-botao">Contrato</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/contrato/telaCadastrar')}}">
                                            Adicionar Contrato
                                        </a>
                                        <a class="dropdown-item" href="{{route('/contrato/listar')}}">
                                            Listagem Contratos
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/escol.png"><div class="titulo-botao">Escola</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/escola/cadastrar')}}">
                                            Adicionar Escola
                                        </a>
                                        <a class="dropdown-item" href="{{route('/escola/listar')}}">
                                            Listagem Escolas
                                        </a>
                                        <a class="dropdown-item" target="_blank" href="{{ route("/escola/RelatorioEscolas") }}">
                                            Imprimir Escolas
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
                                            Listagem Itens
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/estoq.png"><div class="titulo-botao">Estoque</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/estoque/cadastrar')}}">
                                            Adicionar Estoque
                                        </a>
                                        <a class="dropdown-item" href="{{route('/estoque/listar')}}">
                                            Listagem Estoques
                                        </a>

                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/refeic.png"><div class="titulo-botao">Refeição</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/refeicao/cadastrar')}}">
                                            Adicionar Refeição
                                        </a>
                                        <a class="dropdown-item" href="{{route('/refeicao/listar')}}">
                                            Listagem Refeições
                                        </a>
                                        <a class="dropdown-item" target="_blank" href="{{ route("/refeicao/RelatorioRefeicoes") }}">
                                            Imprimir Refeições
                                        </a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/cardap.png"><div class="titulo-botao">Cardápio</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/cardapio/cadastrar')}}">
                                            Adicionar Cardápio
                                        </a>
                                        <a class="dropdown-item" href="{{route('/cardapio/listar')}}">
                                            Listagem Cardápios
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/distri.png"><div class="titulo-botao">Distribuição</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="{{route('/distribuicao/telaCadastrar')}}">
                                            Adicionar Distribuição
                                        </a>
                                        <a class="dropdown-item" href="{{route('/distribuicao/listar')}}">
                                            Listagem Distribuições
                                        </a>
                                    </div>
                                </div>
                                @else
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/fornec.png"><div class="titulo-botao">Fornecedor</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/fornecedor/listar')}}">
                                Listagem Fornecedores
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/contra.png"><div class="titulo-botao">Contrato</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/contrato/listar')}}">
                                Listagem Contratos
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/escol.png"><div class="titulo-botao">Escola</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/escola/listar')}}">
                                Listagem Escolas
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/distri.png"><div class="titulo-botao">Distribuição</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/distribuicao/listar')}}">
                                Listagem Distribuições
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/item.png"><div class="titulo-botao">Item</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/item/listar')}}">
                                Listagem Itens
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/estoq.png"><div class="titulo-botao">Estoque</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/estoque/listar')}}">
                                Listagem Estoques
                              </a>

                          </div>
                      </div>

                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/refeic.png"><div class="titulo-botao">Refeição</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/refeicao/listar')}}">
                                Listagem Refeições
                              </a>
                          </div>
                      </div>

                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/cardap.png"><div class="titulo-botao">Cardápio</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="{{route('/cardapio/listar')}}">
                                Listagem Cardápios
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
                            <li class="dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                    @if (Auth::user()->is_adm)
                                        <img class="adm-img btn-img" src="/img/adm.png">   
                                    @endif
                                </a>
                                <div class="dropdown-content" aria-labelledby="navbarDropdown">

                                @if (Auth::user()->is_adm)
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        {{'Novo'}}
                                        <img class="btn-img" src="/img/cadastro.png">
                                    </a>
                                @endif
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
