<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">

      <?php if(Auth::guard()->check() && Auth::user()->is_adm): ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <center><strong>Estoque</strong><center>
                </div>
                <a href="<?php echo e(route('/estoque/listar')); ?>" >
                    <div class="card-body">
                      <div class="panel-body">
                        <div id ="img" style="padding-bottom: 5px;"><center><img class="btn-img" align="center" src="/img/estoq.png">
                        </center></div>
                      </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <center><strong>Cardápio</strong><center>
                </div>
                <a href="<?php echo e(route('/cardapio/listar')); ?>" >
                    <div class="card-body">
                      <div class="panel-body">
                        <div id ="img"><center>
                        <img class="btn-img" src="/img/cardap.png">
                        </center></div>
                      </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <center><strong>Distribuição</strong><center>
                </div>
                <a href="<?php echo e(route('/distribuicao/listar')); ?>" >
                    <div class="card-body">
                      <div class="panel-body">
                        <div id ="img" style="padding-bottom: 5px;"><center>
                        <img class="btn-img" src="/img/distri.png">
                        </center></div>
                      </div>
                    </div>
                </a>
            </div>
        </div>
        <div style="width:80%">
          <br>
            <div class="card">
                <div class="card-header"><h3 align="center">Sistema Magaly</h3>
                </div>

                <div class="card-body">
                  <div class="panel-body">
                      <p align="justify">
                          O Sistema de Gestão Alimentar <strong>Magaly</strong> tem como objetivo facilitar as atividades de gerenciamento da merenda escolar, permitindo de forma simples o controle de estoque, de distribuições, a criação de refeições e cardápios e o acesso rápido aos dados cadastrados no sistema.
                          <br><br>
                          seducdivtecnologia@gmail.com
                      </p>
                  </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="col-md-7">
          <br>
            <div class="card">
                <div class="card-header"><h3 align="center">Sistema Magaly</h3>
                </div>

                <div class="card-body">
                  <div class="panel-body">
                      <p align="justify">
                          O Sistema de Gestão Alimentar <strong>Magaly</strong> tem como objetivo facilitar as atividades de gerenciamento da merenda escolar, permitindo de forma simples o controle de estoque, de distribuições, a criação de refeições e cardápios e o acesso rápido aos dados cadastrados no sistema.
                          <br><br>
                          seducdivtecnologia@gmail.com
                      </p>
                  </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/home.blade.php ENDPATH**/ ?>