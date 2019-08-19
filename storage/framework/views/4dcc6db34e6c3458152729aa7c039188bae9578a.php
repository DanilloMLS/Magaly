<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
            <div class="card">
                <div class="card-header"><?php echo e(__('Cadastrar Fornecedor')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('/fornecedor/cadastrar')); ?>">
                      <?php echo e(csrf_field()); ?>

                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nome ')); ?></label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" required value= <?php echo e(old('nome')); ?>> <?php echo e($errors->first('nome')); ?>



                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cnpj" class="col-md-4 col-form-label text-md-right"><?php echo e(__('CNPJ')); ?></label>

                            <div class="col-md-6">
                                <input id="cnpj" type="cnpj" class="form-control<?php echo e($errors->has('cnpj') ? ' is-invalid' : ''); ?>" name="cnpj" value="<?php echo e(old('cnpj')); ?>" required>

                                <?php if($errors->has('cnpj')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('cnpj')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Telefone')); ?></label>

                            <div class="col-md-6">
                              <input name="telefone" id="telefone" type="text" class="form-control" required value= <?php echo e(old('telefone')); ?>> <?php echo e($errors->first('telefone')); ?>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/CadastrarFornecedor.blade.php ENDPATH**/ ?>