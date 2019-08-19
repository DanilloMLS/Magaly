<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Cadastrar Distribuição')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('/distribuicao/cadastrar')); ?>">
                      <?php echo e(csrf_field()); ?>

                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="observacao" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Observação ')); ?></label>

                            <div class="col-md-6">
                              <textarea name="observacao" id="observacao" type="text" class="form-control" value= <?php echo e(old('observacao')); ?>> <?php echo e($errors->first('observacao')); ?></textarea>


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_escola" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Escola')); ?></label>
                            <?php if(count($escolas) != 0 and count($escolas) != 0): ?>
                            <div class="col-md-6">
                              <select class="form-control" id="escolas" name="escola_id" required>
      								              <option value="">Selecione uma Escola</option>
      								              <?php $__currentLoopData = $escolas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $escola): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      									            <option value="<?php echo e($escola->id); ?>"><?php echo e($escola->nome); ?></option>
      								              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                            <?php else: ?>
                            <div class="col-md-6">
                              <select class="form-control" id="escolas" name="escola_id" required>
      								              <option value="">Não há escolas cadastradas</option>
                              </select>
                            </div>
                            <?php endif; ?>
                         </div>

                         <div class="form-group row">
                             <label for="id_cardapio" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Cardápio')); ?></label>
                             <?php if(count($cardapios) != 0 and count($cardapios) != 0): ?>
                             <div class="col-md-6">
                               <select class="form-control" id="cardapios" name="cardapio_id" required>
       								              <option value="">Selecione um Cardápio</option>
       								              <?php $__currentLoopData = $cardapios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cardapio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       									            <option value="<?php echo e($cardapio->id); ?>"><?php echo e($cardapio->nome); ?></option>
       								              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>
                             </div>
                             <?php else: ?>
                             <div class="col-md-6">
                               <select class="form-control" id="escolas" name="escola_id" required>
       								              <option value="">Não há escolas cadastradas</option>
                               </select>
                             </div>
                             <?php endif; ?>
                          </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Cadastrar
                              </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/CadastrarDistribuicao.blade.php ENDPATH**/ ?>