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
                          <h5 class="card-title">
                            Exibindo <?php echo e($estoques->count()); ?> estoques de <?php echo e($estoques->total()); ?> 
                            (<?php echo e($estoques->firstItem()); ?> a <?php echo e($estoques->lastItem()); ?>)
                          </h5>
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Id</th>
                                  <th >Nome</th>
                                  <th align="center">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $estoques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estoque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-title="Id" title="Clique para listar os itens" onClick="listarItens(<?php echo e($estoque->id); ?>)"><?php echo e($estoque->id); ?></td>
                                    <td data-title="Nome" title="Clique para listar os itens" onClick="listarItens(<?php echo e($estoque->id); ?>);"><?php echo e($estoque->nome); ?></td>
                                    <td>
                                      <a title="Inserir Novo Item" class="btn btn-primary" href="<?php echo e(route ("/estoque/novoItemEstoque", ['id' => $estoque->id])); ?>">
                                        <img src="/img/add_item.png" height="21" width="21" align = "right">
                                      </a>
                                      <a title="Histórico de Movimentações" class="btn btn-primary" href="<?php echo e(route ("/estoque/historicoEstoque", ['id' => $estoque->id])); ?>">
                                        <img src="/img/history.png" height="21" width="21" align = "right">
                                      </a>
                                      <a title="Remover Estoque" class="btn btn-primary" onClick="avisoDeletar(<?php echo e($estoque->id); ?>);">
                                        <img src="/img/delete.png" height="21" width="17" align = "right">
                                      </a>
                                      <a title="Renomear" class="btn btn-primary" onClick="renomear(<?php echo e($estoque->id); ?>);">
                                        <img src="/img/edit.png" height="21" width="17" align = "right">
                                      </a>
                                    </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                          </table>
                          <?php echo e($estoques->links()); ?>

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