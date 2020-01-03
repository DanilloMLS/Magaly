<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Histórico de movimentação deste estoque')); ?></div>

                <div class="card-body">

                  <?php if(\Session::has('success')): ?>
                  <br>
                      <div class="alert alert-success">
                          <?php echo \Session::get('success'); ?>

                      </div>
                  <?php endif; ?>
                  <div class="panel-body">
                      <?php if(count($itens_historico) == 0 and count($itens_historico) == 0): ?>
                      <div class="alert alert-danger">
                              Não há movimentações de itens neste estoque.
                      </div>
                      <?php else: ?>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Operação</th>
                                  <th>Item</th>
                                  <th>Quantidade</th>
                                  <th>Quantidade danificados</th>
                                  <th>Data e hora</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $itens_historico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_historico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php
                                      $item = \App\Item::find($item_historico->item_id);
                                    ?>
                                    <td data-title="Operação"><?php echo e($item_historico->operacao); ?></td>
                                    <td data-title="Item"><?php echo e($item->nome); ?></td>
                                    <td data-title="Quantidade"><?php echo e($item_historico->quantidade); ?></td>
                                    <td data-title="Quantidade danificados"><?php echo e($item_historico->quantidade_danificados); ?></td>
                                    <td data-title="Data e hora"><?php echo e($item_historico->created_at); ?></td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                          </table>
                        </div>
                      <?php endif; ?>
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="<?php echo e(route ('/estoque/listar')); ?>">Voltar</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/HistoricoEstoque.blade.php ENDPATH**/ ?>