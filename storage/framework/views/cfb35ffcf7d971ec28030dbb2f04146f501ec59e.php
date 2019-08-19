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
                              Você ainda não cadastrou nenhum item.
                      </div>
                      <?php else: ?>
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                              <div class="form-group row">
                                <div class="col-md-2">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-2">
                                  Gramatura
                                </div>
                                <div class="col-md-2">
                                  <center>Falta</center>
                                </div>
                                <div class="col-md-2">
                                  <center>Danificados</center>
                                </div>
                                <div class="col-md-2">
                                  <center>Total</center>
                                </div>
                              </div>
                              <?php $__currentLoopData = $itens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <form method="POST" action="/distribuicao/inserirItem">
                                <?php echo e(csrf_field()); ?>

                                  <?php echo csrf_field(); ?>
                              <input type="hidden" name="distribuicao_id" value="<?php echo e($distribuicao->id); ?>" />
                              <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>" />

                              <div class="form-group row">

                                  <div class="col-md-2">
                                    <?php echo e($item->nome); ?>

                                  </div>
                                  <div class="col-md-1">
                                    <?php echo e($item->gramatura); ?>

                                  </div>

                                  <div class="col-md-2">
                                    <input name="quantidade_falta" id="quantidade_falta" type="number"  class="form-control" value= <?php echo e(old('quantidade_falta')); ?>> <?php echo e($errors->first('quantidade_falta')); ?>

                                  </div>
                                  <div class="col-md-2">
                                    <input name="quantidade_danificados" id="quantidade_danificados" type="number"  class="form-control" value= <?php echo e(old('quantidade_danificado')); ?>> <?php echo e($errors->first('quantidade_danificados')); ?>

                                  </div>
                                  <div class="col-md-2">
                                    <input name="quantidade" id="quantidade" type="number"  class="form-control" required value= <?php echo e(old('quantidade')); ?>> <?php echo e($errors->first('quantidade')); ?>

                                  </div>
                                  <div class="col-md-1">
                                    <?php
                                        $distribuicao_item = \App\Distribuicao_item::where('distribuicao_id', '=', $distribuicao->id)
                                                                                ->where('item_id', '=', $item->id)
                                                                                ->first();
                                        if(empty($distribuicao_item)){ ?>
                                          <button class="btn btn-success" type="submit">+</button>
                                      <?php } else { ?>
                                        <a class="btn btn-danger" href="/distribuicao/removerItem/<?php echo e($distribuicao_item->id); ?>">
                                        -
                                        </a>
                                    <?php } ?>

                                  </div>
                              </div>

                            </form>


                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                      <?php endif; ?>
                  </div>
                  <div class="panel-footer">
                      <center><a class="btn btn-primary" href="/distribuicao/finalizarDistribuicao/<?php echo e($distribuicao->id); ?>">Concluir</a></center>
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