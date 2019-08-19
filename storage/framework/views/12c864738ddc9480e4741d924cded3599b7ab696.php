<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Refeições')); ?></div>

                <div class="card-body">

                  <?php if(\Session::has('success')): ?>
                  <br>
                      <div class="alert alert-success">
                          <?php echo \Session::get('success'); ?>

                      </div>
                  <?php endif; ?>
                  <div class="panel-body">
                      <?php if(count($refeicoes) == 0 and count($refeicoes) == 0): ?>
                      <div class="alert alert-danger">
                              Não há nenhuma refeição cadastrada no sistema.
                      </div>
                      <?php else: ?>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Descrição</th>
                                  <th>Peso líquido</th>
                                  <th>Itens</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $refeicoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refeicao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-title="Nome"><?php echo e($refeicao->nome); ?></td>
                                    <td data-title="Descricao"><?php echo e($refeicao->descricao); ?></td>
                                    <td data-title="Peso_liquido"><?php echo e($refeicao->peso_liquido); ?></td>

                                    <td>
                                      <a class="btn btn-primary" href="/refeicao/exibirItensRefeicao/<?php echo e($refeicao->id); ?>">Itens</a>
                                    </td>


                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                          </table>
                        </div>
                      <?php endif; ?>
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="<?php echo e(URL::previous()); ?>">Voltar</a>
                      <a class="btn btn-primary" target="_blank" href="<?php echo e(route("/refeicao/RelatorioRefeicoes")); ?>">Relatório</a>
                      <a class="btn btn-primary" href="<?php echo e(route("/refeicao/cadastrar")); ?>">Novo</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/ListarRefeicoes.blade.php ENDPATH**/ ?>