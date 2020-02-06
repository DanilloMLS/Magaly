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
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Descrição</th>
                                  <th>Data de Validade</th>
                                  <th>Nº Lote</th>
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
                                      $validade_lote = \App\Contrato_item::where('item_id','=',$item_estoque->item_id)->first();
                                    ?>
                                    <td data-title="Valor unitário"><?php echo e($item->nome); ?></td>
                                    <td data-title="Descrição"><?php echo e($item->descricao); ?></td>
                                    <td data-title="Data de Validade"><?php echo e($validade_lote->data_validade); ?></td>
                                    <td data-title="Nº Lote"><?php echo e($validade_lote->n_lote); ?></td>
                                    <td data-title="Unidade"><?php echo e($item->unidade); ?></td>
                                    <td data-title="Gramatura"><?php echo e($item->gramatura); ?></td>
                                    <td data-title="Danificados"><?php echo e($item_estoque->quantidade_danificados); ?></td>
                                    <td data-title="Quantidade disponível"><?php echo e($item_estoque->quantidade); ?></td>

                                    <td>
                                        <a class="btn btn-primary" href="<?php echo e(route ("/estoque/inserirEntrada", ['id' => $item_estoque->id])); ?>">Entrada</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="<?php echo e(route ("/estoque/inserirSaida", ['id' => $item_estoque->id])); ?>">Saída</a>
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
                      <a class="btn btn-primary" href="<?php echo e(route ('/estoque/listar')); ?>">Voltar</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function buscar() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("termo");
      filter = input.value.toUpperCase();
      table = document.getElementById("tabela");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/VisualizarItensEstoque.blade.php ENDPATH**/ ?>