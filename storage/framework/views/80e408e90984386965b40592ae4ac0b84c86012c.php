<?php $__env->startSection('content'); ?>

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm (' Deseja realmente excluir esta distribuição? ')) {
    location.href="/distribuicao/remover/"+id;
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
                <div class="card-header"><?php echo e(__('Distribuições')); ?></div>

                <div class="card-body">

                  <?php if(\Session::has('success')): ?>
                  <br>
                      <div class="alert alert-success">
                          <?php echo \Session::get('success'); ?>

                      </div>
                  <?php endif; ?>
                  <div class="panel-body">
                      <?php if(count($distribuicoes) == 0 and count($distribuicoes) == 0): ?>
                      <div class="alert alert-danger">
                              Não há nenhuma distribuição cadastrada no sistema.
                      </div>
                      <?php else: ?>
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Observação</th>
                                  <th>Escola</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $distribuicoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distribuicao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-title="Observação"><?php echo e($distribuicao->observacao); ?></td>
                                    <?php $escola = \App\Escola::find($distribuicao->escola_id)?>
                                    <td data-title="Modalidade de Ensino"><?php echo e($escola->nome); ?></td>

                                    <td>
                                      <a class="btn btn-primary" href="<?php echo e(route ("/distribuicao/exibirItensDistribuicao", ['id' => $distribuicao->id])); ?>">Itens</a>
                                    </td>


                                    <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar(<?php echo e($distribuicao->id); ?>);">
                                        <img src="/img/delete.png" height="21" width="17" align = "right">
                                      </a>
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
                      <a class="btn btn-primary" target="_blank" href="<?php echo e(route("/distribuicao/RelatorioDistribuicoes")); ?>">Relatório</a>
                      <a class="btn btn-primary" href="<?php echo e(route("/distribuicao/telaCadastrar")); ?>">Nova</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/ListarDistribuicoes.blade.php ENDPATH**/ ?>