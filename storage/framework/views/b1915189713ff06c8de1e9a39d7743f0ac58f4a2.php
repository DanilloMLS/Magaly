<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Cadastrar Contrato')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('/contrato/cadastrar')); ?>">
                      <?php echo e(csrf_field()); ?>

                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="data" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Data ')); ?></label>

                            <div class="col-md-6">
                              <input name="data" id="data" type="date" class="form-control" required value= <?php echo e(old('data')); ?>> <?php echo e($errors->first('data')); ?>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="n_contrato" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nº Contrato ')); ?></label>

                            <div class="col-md-6">
                              <input name="n_contrato" id="n_contrato" type="text" class="form-control" required value= <?php echo e(old('n_contrato')); ?>> <?php echo e($errors->first('n_contrato')); ?>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="n_processo_licitatorio" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nº Processo Licitatório ')); ?></label>

                            <div class="col-md-6">
                              <input name="n_processo_licitatorio" id="n_processo_licitatorio" type="text" class="form-control" required value= <?php echo e(old('n_processo_licitatorio')); ?>> <?php echo e($errors->first('n_processo_licitatorio')); ?>

                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="modalidade" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Modalidade ')); ?></label>

                          <div class="col-md-6">
                            <input name="modalidade" id="modalidade" type="text" class="form-control" required value= <?php echo e(old('n_processo_licitatorio')); ?>> <?php echo e($errors->first('modalidade')); ?>

                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Descrição ')); ?></label>

                            <div class="col-md-6">
                              <textarea name="descricao" id="descricao" type="date" class="form-control" value= <?php echo e(old('descricao')); ?>> <?php echo e($errors->first('descricao')); ?> </textarea>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="valor_total" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Valor Total ')); ?></label>

                            <div class="col-md-6">
                              <input name="valor_total" id="valor_total" placeholder="0.0" type="text" pattern="^[-+]?[0-9]*\.?[0-9]+$" class="form-control" required value= <?php echo e(old('valor_total')); ?>> <?php echo e($errors->first('valor_total')); ?>

                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="fornecedor_id" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Fornecedor')); ?></label>
                            <?php if(count($fornecedores) != 0 and count($fornecedores) != 0): ?>
                            <div class="col-md-6">
                              <select class="form-control" id="fornecedores" name="fornecedor_id" required>
      								              <option value="">Selecione um Fornecedor</option>
      								              <?php $__currentLoopData = $fornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      									            <option value="<?php echo e($fornecedor->id); ?>"><?php echo e($fornecedor->nome); ?></option>
      								              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                            <?php else: ?>
                            <div class="col-md-6">
                              <select class="form-control" id="fornecedores" name="fornecedor_id" required>
      								              <option value="">Não há fornecedores cadastrados</option>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/CadastrarContrato.blade.php ENDPATH**/ ?>