<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Magaly')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/menu.css')); ?>" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/home')); ?>">
                    Magaly
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      <!-- USer ADM -->
                        <?php if(Auth::guard()->check() && Auth::user()->is_adm): ?>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/fornec.png"><div class="titulo-botao">Fornecedor</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="<?php echo e(route('/fornecedor/cadastrar')); ?>">
                                            Novo Fornecedor
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('/fornecedor/listar')); ?>">
                                            Listar Fornecedores
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/contra.png"><div class="titulo-botao">Contrato</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="<?php echo e(route('/contrato/telaCadastrar')); ?>">
                                            Novo Contrato
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('/contrato/listar')); ?>">
                                            Listar Contratos
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/escol.png"><div class="titulo-botao">Escola</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="<?php echo e(route('/escola/cadastrar')); ?>">
                                            Nova Escola
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('/escola/listar')); ?>">
                                            Listar Escolas
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/distri.png"><div class="titulo-botao">Distribuição</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="<?php echo e(route('/distribuicao/telaCadastrar')); ?>">
                                            Nova Distribuição
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('/distribuicao/listar')); ?>">
                                            Listar Distribuições
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/item.png"><div class="titulo-botao">Item</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="<?php echo e(route('/item/telaCadastrar')); ?>">
                                            Novo Item
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('/item/listar')); ?>">
                                            Listar Itens
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/estoq.png"><div class="titulo-botao">Estoque</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="<?php echo e(route('/estoque/cadastrar')); ?>">
                                            Novo Estoque
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('/estoque/listar')); ?>">
                                            Listar Estoques
                                        </a>

                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/refeic.png"><div class="titulo-botao">Refeição</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="<?php echo e(route('/refeicao/cadastrar')); ?>">
                                            Nova Refeição
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('/refeicao/listar')); ?>">
                                            Listar Refeições
                                        </a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/cardap.png"><div class="titulo-botao">Cardápio</div></button>
                                    <div class="dropdown-content">
                                        <a class="dropdown-item" href="<?php echo e(route('/cardapio/cadastrar')); ?>">
                                            Novo Cardápio
                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('/cardapio/listar')); ?>">
                                            Listar Cardápios
                                        </a>
                                    </div>
                                </div>
                      <?php else: ?>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/fornec.png"><div class="titulo-botao">Fornecedor</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="<?php echo e(route('/fornecedor/listar')); ?>">
                                  Listar Fornecedores
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/contra.png"><div class="titulo-botao">Contrato</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="<?php echo e(route('/contrato/listar')); ?>">
                                  Listar Contratos
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/escol.png"><div class="titulo-botao">Escola</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="<?php echo e(route('/escola/listar')); ?>">
                                  Listar Escolas
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/distri.png"><div class="titulo-botao">Distribuição</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="<?php echo e(route('/distribuicao/listar')); ?>">
                                  Listar Distribuições
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/item.png"><div class="titulo-botao">Item</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="<?php echo e(route('/item/listar')); ?>">
                                  Listar Itens
                              </a>
                          </div>
                      </div>
                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/estoq.png"><div class="titulo-botao">Estoque</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="<?php echo e(route('/estoque/listar')); ?>">
                                  Listar Estoques
                              </a>

                          </div>
                      </div>

                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/refeic.png"><div class="titulo-botao">Refeição</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="<?php echo e(route('/refeicao/listar')); ?>">
                                  Listar Refeições
                              </a>
                          </div>
                      </div>

                      <div class="dropdown">
                          <button class="dropbtn btn-Fornecedor"><img class="btn-img" src="/img/cardap.png"><div class="titulo-botao">Cardápio</div></button>
                          <div class="dropdown-content">
                              <a class="dropdown-item" href="<?php echo e(route('/cardapio/listar')); ?>">
                                  Listar Cardápios
                              </a>
                          </div>
                      </div>
                      <?php endif; ?>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                            </li>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Cadastro')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Sair')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    <footer class="container-fluid text-center" >
      <img class=" logo-garanhuns left" src="/img/logo.png">
    </footer>
    <footer class="container-fluid text-center">

  </footer>

</body>
</html>
<?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/layouts/app.blade.php ENDPATH**/ ?>