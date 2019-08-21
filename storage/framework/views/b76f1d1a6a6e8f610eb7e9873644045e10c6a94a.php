<?php $__env->startSection('content'); ?>

<script language= 'javascript'>
  function avisoDeletar(id){
    if(confirm (' Deseja realmente excluir este item? ')) {
      location.href="/estoque/removerItem/"+id;
    }
    else {
      return false;
    }
  }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Itens deste estoque')); ?></div>

                <div class="card-body">

                  <?php if(\Session::has('success')): ?>
                  <br>
                      <div class="alert alert-success">
                          <?php echo \Session::get('success'); ?>

                      </div>
                  <?php endif; ?>
                  <div class="panel-body">
                      <?php if(count($itens) == 0 and count($itens) == 0): ?>
                      <div class="alert alert-danger">
                              Não há nenhum item neste estoque.
                      </div>
                      <?php else: ?>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Data de validade</th>
                                  <th>Nº lote</th>
                                  <th>Descrição</th>
                                  <th>Unidade</th>
                                  <th>Gramatura</th>
                                  <th>Danificados</th>
                                  <th>Quantidade disponível</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $itens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_estoque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php
                                      $item = \App\Item::find($item_estoque->item_id);
                                    ?>
                                    <td data-title="Valor unitário"><?php echo e($item->nome); ?></td>
                                    <td data-title="Data de validade"><?php echo e($item->data_validade); ?></td>
                                    <td data-title="Nº lote"><?php echo e($item->n_lote); ?></td>
                                    <td data-title="Descrição"><?php echo e($item->descricao); ?></td>
                                    <td data-title="Unidade"><?php echo e($item->unidade); ?></td>
                                    <td data-title="Gramatura"><?php echo e($item->gramatura); ?></td>
                                    <td data-title="Danificados"><?php echo e($item_estoque->quantidade_danificados); ?></td>
                                    <td data-title="Quantidade disponível"><?php echo e($item_estoque->quantidade); ?></td>

                                    <td>
                                        <a class="btn btn-primary" href="/estoque/inserirEntrada/<?php echo e($item_estoque->id); ?>">Entrada</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="/estoque/inserirSaida/<?php echo e($item_estoque->id); ?>">Saída</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" onClick="avisoDeletar(<?php echo e($item_estoque->id); ?>);">Excluir</a>
                                    </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                          </table>
                        </div>
                      <?php endif; ?>
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="/estoque/listar">Voltar</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/VisualizarItensEstoque.blade.php ENDPATH**/ ?>