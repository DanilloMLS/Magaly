<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Cadastrar Cardápio')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('/cardapio/salvar')); ?>">
                      <?php echo e(csrf_field()); ?>

                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Modalidade de ensino')); ?></label>
                            <div class="col-md-6">
                              <select class="form-control" id="modalidade_ensino" name="modalidade_ensino" required>
      								              <option value="0">Selecione uma Modalidade de ensino</option>
      									            <option value="1">Creche Infantil Integral</option>
                                    <option value="2">Creche Infantil Parcial</option>
                                    <option value="3">Infantil (pré-escola)</option>
                                    <option value="4">Ensino Fundamental</option>
                                    <option value="5">EJA</option>
                                    <option value="6">Quilombola</option>
                              </select>
                            </div>
                         </div>

                         <div class="form-group row">
                             <label for="data_inicio" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Data de início')); ?></label>
                             <div class="col-md-6">
                               <input type="date" id="data_inicio" required name="data_inicio">
                             </div>
                          </div>

                          <div class="form-group row">
                              <label for="data_fim" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Data de fim')); ?></label>
                              <div class="col-md-6">
                                <input type="date" id="data_fim" required name="data_fim">
                              </div>
                           </div>

                           <div class="form-group row">
                               <label for="nome" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nome')); ?></label>
                               <div class="col-md-6">
                                 <input id="nome" required name="nome">
                               </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                              <button type="submit" class="btn btn-primary">
                                  Inserir Refeições
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/CadastrarCardapio.blade.php ENDPATH**/ ?>