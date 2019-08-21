<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Itens deste contrato')); ?></div>

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
                              Não há nenhum item neste contrato.
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
                                  <th>Nº Lote</th>
                                  <th>Data de validade</th>
                                  <th>Descrição</th>
                                  <th>Unidade</th>
                                  <th>Gramatura</th>
                                  <th>Quantidade</th>
                                  <th>Valor unitário</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $itens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php
                                      $item = \App\Item::find($item_contrato->item_id);
                                    ?>
                                    <td data-title="Nome"><?php echo e($item->nome); ?></td>
                                    <td data-title="Nº Lote"><?php echo e($item_contrato->n_lote); ?></td>
                                    <td data-title="Data de validade"><?php echo e($item_contrato->data_validade); ?></td>
                                    <td data-title="Descrição"><?php echo e($item->descricao); ?></td>
                                    <td data-title="Unidade"><?php echo e($item->unidade); ?></td>
                                    <td data-title="Gramatura"><?php echo e($item->gramatura); ?></td>
                                    <td data-title="Quantidade"><?php echo e($item_contrato->quantidade); ?></td>
                                    <td data-title="Valor Unitario"><?php echo e($item_contrato->valor_unitario); ?></td>

                                    </td>


                                    <td></td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                          </table>
                        </div>
                      <?php endif; ?>
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="<?php echo e(route ('/contrato/listar')); ?>">Voltar</a>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/VisualizarItensContrato.blade.php ENDPATH**/ ?>