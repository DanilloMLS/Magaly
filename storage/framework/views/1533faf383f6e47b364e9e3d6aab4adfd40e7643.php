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
                <div class="card-header"><?php echo e(__('Cadastrar Escola')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('/escola/cadastrar')); ?>">
                      <?php echo e(csrf_field()); ?>

                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nome ')); ?></label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" required value= <?php echo e(old('nome')); ?>> <?php echo e($errors->first('nome')); ?>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Modalidade de ensino')); ?></label>

                              <div class="col-md-6">
                                <select class="form-control" id="modalidade_ensino" name="modalidade_ensino" required>
        								              <option value="">Selecione uma Modalidade de ensino</option>
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
                            <label for="endereco" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Endereço')); ?></label>

                            <div class="col-md-6">
                              <textarea name="endereco" id="endereco" type="text" class="form-control" value= <?php echo e(old('endereco')); ?>> <?php echo e($errors->first('endereco')); ?></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="rota" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Rota')); ?></label>

                            <div class="col-md-6">
                              <textarea name="rota" id="rota" type="text" class="form-control" value= <?php echo e(old('rota')); ?>> <?php echo e($errors->first('rota')); ?></textarea>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="periodo_atendimento" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Período de atendimento')); ?></label>

                            <div class="col-md-6">
                              <input name="periodo_atendimento" id="periodo_atendimento" type="text" class="form-control" value= <?php echo e(old('periodo_atendimento')); ?>> <?php echo e($errors->first('periodo_atendimento')); ?></input>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qtde_alunos" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Quantidade de alunos')); ?></label>

                            <div class="col-md-6">
                              <input name="qtde_alunos" id="qtde_alunos" type="text" type="text" pattern="^[-+]?[0-9]*" class="form-control" required value= <?php echo e(old('qtde_alunos')); ?>> <?php echo e($errors->first('qtde_alunos')); ?></input>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gestor" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nome do gestor')); ?></label>

                            <div class="col-md-6">
                              <input name="gestor" id="gestor" type="text" class="form-control" value= <?php echo e(old('gestor')); ?>> <?php echo e($errors->first('gestor')); ?></input>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Telefone')); ?></label>

                            <div class="col-md-6">
                              <input name="telefone" id="telefone" type="text" class="form-control" value= <?php echo e(old('telefone')); ?>> <?php echo e($errors->first('telefone')); ?></input>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/CadastrarEscola.blade.php ENDPATH**/ ?>