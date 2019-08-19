<?php $__env->startSection('content'); ?>

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm ('Esta ação removerá do sistema todas as distribuições dessa escola. Deseja realmente excluí-la? ')) {
    location.href="/escola/remover/"+id;
  }
  else {
    return false;
  }
}

function editar(id){
  location.href="/escola/editar/"+id;
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Escolas')); ?></div>

                <div class="card-body">

                  <?php if(\Session::has('success')): ?>
                  <br>
                      <div class="alert alert-success">
                          <?php echo \Session::get('success'); ?>

                      </div>
                  <?php endif; ?>
                  <div class="panel-body">
                      <?php if(count($escolas) == 0 and count($escolas) == 0): ?>
                      <div class="alert alert-danger">
                              Não há nenhuma escola cadastrada no sistema.
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
                                  <th>Modalidade de Ensino</th>
                                  <th>Rota</th>
                                  <th>Endereço</th>
                                  <th>Período de Atendimento</th>
                                  <th>Quantidade de Alunos</th>
                                  <th>Gestor</th>
                                  <th>Telefone</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $escolas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $escola): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-title="Nome" title="Clique para editar" onclick="editar(<?php echo e($escola->id); ?>);"><?php echo e($escola->nome); ?></td>
                                    <td data-title="Modalidade de Ensino"><?php echo e($escola->modalidade_ensino); ?></td>
                                    <td data-title="Rota"><?php echo e($escola->rota); ?></td>
                                    <td data-title="Endereco"><?php echo e($escola->endereco); ?></td>
                                    <td data-title="Período de Atendimento"><?php echo e($escola->periodo_atendimento); ?></td>
                                    <td data-title="Quantidade de Alunos"><?php echo e($escola->qtde_alunos); ?></td>
                                    <td data-title="Gestor"><?php echo e($escola->gestor); ?></td>
                                    <td data-title="Telefone"><?php echo e($escola->telefone); ?></td>

                                    
                                    <td>
                                      <a class="btn btn-primary"  href="/escola/editar/<?php echo e($escola->id); ?>">
                                        <img src="/img/edit.png" height="21" width="17" align = "right">
                                      </a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar(<?php echo e($escola->id); ?>);">
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
                      <a class="btn btn-primary" target="_blank" href="<?php echo e(route("/escola/RelatorioEscolas")); ?>">Relatório</a>
                      <a class="btn btn-primary" href="<?php echo e(route("/escola/cadastrar")); ?>">Nova</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/ListarEscolas.blade.php ENDPATH**/ ?>