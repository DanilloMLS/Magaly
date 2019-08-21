<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?php echo e(__('Inserir Itens')); ?></div>

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
                              Você ainda não cadastrou nenhum item neste cardápio.
                      </div>
                      <?php else: ?>
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                              <strong><div class="form-group row">
                                <div class="col-md-3">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-3">
                                  Descrição
                                </div>
                                <div class="col-md-2">
                                  <center>Quantidade Total</center>
                                </div>
                              </div></strong>
                              <?php $__currentLoopData = $itens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                              <div class="form-group row">

                                  <div class="col-md-3">
                                    <?php
                                    $item_nome = \App\Item::find($item->item_id);
                                    ?>
                                    <?php echo e($item_nome->nome); ?>

                                  </div>

                                  <div class="col-md-3">
                                    <?php
                                    $item_descricao = \App\Item::find($item->item_id);
                                    ?>
                                    <?php echo e($item_descricao->descricao); ?>

                                  </div>

                                  <div class="col-md-2">
                                    <?php echo e($item->quantidade_total); ?>

                                  </div>

                              </div>

                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                      <?php endif; ?>
                  </div>
                  <div class="panel-footer">
                      <center><a class="btn btn-primary" href="<?php echo e(route ('/distribuicao/listar')); ?>">Confirmar</a></center>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/InserirItensDistribuicao.blade.php ENDPATH**/ ?>