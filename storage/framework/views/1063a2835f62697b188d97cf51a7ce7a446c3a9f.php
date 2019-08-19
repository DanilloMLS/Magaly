<?php $__env->startSection('content'); ?>

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm (' Deseja realmente excluir este estoque? ')) {
    location.href="/estoque/remover/"+id;
  }
  else {
    return false;
  }
}

function renomear(id){
  location.href="/estoque/editar/"+id;
}

function listarItens(id){
  location.href="/estoque/exibirItensEstoque/"+id;
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Estoques')); ?></div>

                <div class="card-body">

                  <?php if(\Session::has('success')): ?>
                  <br>
                      <div class="alert alert-success">
                          <?php echo \Session::get('success'); ?>

                      </div>
                  <?php endif; ?>
                  <div class="panel-body">
                      <?php if(count($estoques) == 0 and count($estoques) == 0): ?>
                      <div class="alert alert-danger">
                              Não há nenhum estoque cadastrado no sistema.
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
                                  <th>Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $estoques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estoque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-title="Nome" title="Clique para listar os itens" onClick="listarItens(<?php echo e($estoque->id); ?>);"><?php echo e($estoque->nome); ?></td>
                                    <td>
                                      <a class="btn btn-primary" href="/estoque/novoItemEstoque/<?php echo e($estoque->id); ?>">Inserir Itens</a>
                                      <a class="btn btn-primary" href="/estoque/historicoEstoque/<?php echo e($estoque->id); ?>">Ver Histórico</a>
                                      <a class="btn btn-primary" onClick="avisoDeletar(<?php echo e($estoque->id); ?>);">
                                        <img src="/img/delete.png" height="21" width="17" align = "right">
                                      </a>
                                    </td>
                                    
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                          </table>
                        </div>
                      <?php endif; ?>
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" target="_blank" href="<?php echo e(route("/estoque/RelatorioEstoques")); ?>">Relatório</a>

                      <a class="btn btn-primary" href="<?php echo e(route("/estoque/cadastrar")); ?>">Novo</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/ListarEstoques.blade.php ENDPATH**/ ?>