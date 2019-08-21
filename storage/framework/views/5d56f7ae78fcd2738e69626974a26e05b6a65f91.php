<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Cadastrar Item')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('/item/cadastrar')); ?>">
                      <?php echo e(csrf_field()); ?>

                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nome ')); ?></label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" required value= <?php echo e(old('nome')); ?>> <?php echo e($errors->first('nome')); ?>


                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="marca" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Marca ')); ?></label>

                          <div class="col-md-6">
                            <input name="marca" id="marca" type="text" class="form-control" required value= <?php echo e(old('marca')); ?>> <?php echo e($errors->first('marca')); ?>


                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Descrição ')); ?></label>

                            <div class="col-md-6">
                              <textarea name="descricao" id="descricao" type="text" class="form-control" value= <?php echo e(old('descricao')); ?>> <?php echo e($errors->first('descricao')); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gramatura" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Gramatura ')); ?></label>

                            <div class="col-md-3">
                              <input name="gramatura" id="n_lote" type="text" placeholder="ex: 100" pattern="^[-+]?[0-9]*" class="form-control" required value= <?php echo e(old('gramatura')); ?>> <?php echo e($errors->first('gramatura')); ?>

                            </div>
                            <div class="col-md-2">
                              <select class="form-control" id="unidade" name="unidade" required>
                                    <option value="">Unidade</option>
                                    <option value="KG">kg</option>
                                    <option value="L">L</option>
                              </select>
                            </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/CadastrarItem.blade.php ENDPATH**/ ?>