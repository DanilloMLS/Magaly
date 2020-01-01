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
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                        <div id="tabela" class="table-responsive">
                          <h5 class="card-title">
                            Exibindo <?php echo e($refeicoes->count()); ?> refeições de <?php echo e($refeicoes->total()); ?> 
                            (<?php echo e($refeicoes->firstItem()); ?> a <?php echo e($refeicoes->lastItem()); ?>)
                          </h5>
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Descrição</th>
                                  <th>Quantidade</th>
                                  <th>Itens</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $refeicoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refeicao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-title="Nome"><?php echo e($refeicao->nome); ?></td>
                                    <td data-title="Descricao"><?php echo e($refeicao->descricao); ?></td>
                                    <td data-title="Quantidade"><?php echo e($refeicao->quantidade_total); ?></td>

                                    <td>
                                      <a class="btn btn-primary" href="<?php echo e(route ("/refeicao/exibirItensRefeicao", ['id' => $refeicao->id])); ?>" >
                                        <img src="/img/item.png" height="21" width="21" align = "right">
                                      </a>
                                    </td>


                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                          </table>
                          <?php echo e($refeicoes->links()); ?>

                        </div>
                      <?php endif; ?>
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" target="_blank" href="<?php echo e(route("/refeicao/RelatorioRefeicoes")); ?>">Relatório</a>
                      <a class="btn btn-primary" href="<?php echo e(route("/refeicao/cadastrar")); ?>">Novo</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/ListarRefeicoes.blade.php ENDPATH**/ ?>