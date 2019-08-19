<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Cardápios')); ?></div>

                <div class="card-body">

                  <?php if(\Session::has('success')): ?>
                  <br>
                      <div class="alert alert-success">
                          <?php echo \Session::get('success'); ?>

                      </div>
                  <?php endif; ?>
                  <div class="panel-body">
                      <?php if(count($cardapios) == 0 and count($cardapios) == 0): ?>
                      <div class="alert alert-danger">
                              Não há nenhum cardápio cadastrado no sistema.
                      </div>
                      <?php else: ?>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Modalidade de Ensino</th>
                                  <th>Data de início</th>
                                  <th>Data de fim</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $cardapios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cardapio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-title="Nome"><?php echo e($cardapio->nome); ?></td>
                                    <td data-title="Modalidade"><?php echo e($cardapio->modalidade_ensino); ?></td>
                                    <td data-title="Data_inicio"><?php echo e($cardapio->data_inicio); ?></td>
                                    <td data-title="Data_fim"><?php echo e($cardapio->data_fim); ?></td>

                                    <td>
                                      <a class="btn btn-primary" href="">ver</a>
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

                      <a class="btn btn-primary" href="<?php echo e(route("/cardapio/cadastrar")); ?>">Novo</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/ListarCardapios.blade.php ENDPATH**/ ?>