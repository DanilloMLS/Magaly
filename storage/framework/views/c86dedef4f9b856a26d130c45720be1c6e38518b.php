<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Contratos')); ?></div>

                <div class="card-body">

                  <?php if(\Session::has('success')): ?>
                  <br>
                      <div class="alert alert-success">
                          <?php echo \Session::get('success'); ?>

                      </div>
                  <?php endif; ?>
                  <div class="panel-body">
                      <?php if(count($contratos) == 0 and count($contratos) == 0): ?>
                      <div class="alert alert-danger">
                              Não há nenhum contrato cadastrado no sistema.
                      </div>
                      <?php else: ?>
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                        <div id="tabela" class="table-responsive">
                          <h5 class="card-title">
                            Exibindo <?php echo e($contratos->count()); ?> contratos de <?php echo e($contratos->total()); ?> 
                            (<?php echo e($contratos->firstItem()); ?> a <?php echo e($contratos->lastItem()); ?>)
                          </h5>
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nº Contrato</th>
                                  <th>Nº Processo</th>
                                  <th>Modalidade</th>
                                  <th>Descrição</th>
                                  <th>Data</th>
                                  <th>Valor Total</th>
                                  <th>Fornecedor</th>
                                  <th>Itens</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $contratos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-title="N_contrato"><?php echo e($contrato->n_contrato); ?></td>
                                    <td data-title="N_processo"><?php echo e($contrato->n_processo_licitatorio); ?></td>
                                    <td data-title="Modalidade"><?php echo e($contrato->modalidade); ?></td>
                                    <td data-title="Descricao"><?php echo e($contrato->descricao); ?></td>
                                    <td data-title="Data"><?php echo e($contrato->data); ?></td>
                                    <td data-title="valor_total"><?php echo e($contrato->valor_total); ?></td>
                                    <?php $fornecedor = \App\Fornecedor::find($contrato->fornecedor_id)?>
                                    <td data-title="Fornecedor"><?php echo e($fornecedor->nome); ?></td>

                                    <td>
                                      <a title="Ver Itens" class="btn btn-primary" href="<?php echo e(route ("/contrato/exibirItensContrato", ['id' => $contrato->id])); ?>" >
                                        <img src="/img/item.png" height="21" width="21" align = "right">
                                      </a>
                                    </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                          </table>
                          <?php echo e($contratos->links()); ?>

                        </div>
                      <?php endif; ?>
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" target="_blank" href="<?php echo e(route("/contrato/RelatorioContratos")); ?>">Relatório</a>

                      <a class="btn btn-primary" href="<?php echo e(route("/contrato/telaCadastrar")); ?>">Novo</a>

                      <td>
                        <a class="btn btn-primary" href ="<?php echo e(route("/contrato/buscar")); ?>">
                          <img src="/img/search.png" height="21" width="19" align = "right">
                        </a>
                      </td>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/ListarContratos.blade.php ENDPATH**/ ?>