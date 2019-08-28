<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Cadastrar Item no Contrato')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('/contrato/inserirItem')); ?>">
                      <?php echo e(csrf_field()); ?>

                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="contrato_id" value="<?php echo e($contrato->id); ?>" />

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
                          <label for="valor_unitario" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Valor Unitário ')); ?></label>

                          <div class="col-md-6">
                            <input name="valor_unitario" id="valor_unitario" placeholder="0.0" required type="text" pattern="[0-9]*\.?[0-9]+$" class="form-control" value= <?php echo e(old('valor_unitario')); ?>> <?php echo e($errors->first('valor_unitario')); ?>

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
                                  <option value="G">g</option>
                                  <option value="ML">ml</option>
                            </select>
                          </div>
                      </div>

                        <div class="form-group row">
                          <label for="quantidade" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Quantidade ')); ?></label>

                          <div class="col-md-6">
                            <input name="quantidade" id="quantidade" type="number" min="0" class="form-control" required value= <?php echo e(old('quantidade')); ?>> <?php echo e($errors->first('quantidade')); ?>

                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="data_validade" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Data de Validade ')); ?></label>

                          <div class="col-md-6">
                            <input name="data_validade" id="data_validade" type="date" class="form-control" required value= <?php echo e(old('data_validade')); ?>> <?php echo e($errors->first('data_validade')); ?>

                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="n_lote" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Lote ')); ?></label>

                          <div class="col-md-6">
                            <input name="n_lote" id="n_lote" type="text" class="form-control" required value= <?php echo e(old('n_lote')); ?>> <?php echo e($errors->first('n_lote')); ?>

                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Inserir
                              </button>
                              <a class="btn btn-primary" href="/contrato/exibirItensContrato/+<?php echo e($contrato->id); ?>">Finalizar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/InserirItensContrato.blade.php ENDPATH**/ ?>