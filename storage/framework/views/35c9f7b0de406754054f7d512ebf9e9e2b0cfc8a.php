<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?php echo e(__('Inserir Refeição')); ?></div>

                <div class="card-body">

                  <?php if(\Session::has('success')): ?>
                  <br>
                      <div class="alert alert-success">
                          <?php echo \Session::get('success'); ?>

                      </div>
                  <?php endif; ?>
                  <div class="panel-body">
                      <?php if(count($refeicoes) == 0 and count($refeicoes) == 0): ?>
                      <div class="alert alert-danger">
                              Você ainda não cadastrou nenhuma refeição.
                      </div>
                      <?php else: ?>
                              <div class="form-group row">
                                <div class="col-md-3">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-2">
                                  Descrição
                                </div>
                              </div>
                              <?php $__currentLoopData = $refeicoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refeicao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <form method="POST" action="/cardapio/inserirItem">
                                <?php echo e(csrf_field()); ?>

                                  <?php echo csrf_field(); ?>
                              <input type="hidden" name="cardapio_diario" value="<?php echo e($cardapio_diario->id); ?>" />
                              <input type="hidden" name="cardapio_mensal" value="<?php echo e($cardapio_mensal->id); ?>" />
                              <input type="hidden" name="cardapio_semanal" value="<?php echo e($cardapio_semanal->id); ?>" />
                              <input type="hidden" name="cardapio_semanal" value="<?php echo e($cardapio_semanal->id); ?>" />
                              <input type="hidden" name="refeicao_id" value="<?php echo e($refeicao->id); ?>" />

                              <div class="form-group row">

                                  <div class="col-md-3">
                                    <?php echo e($refeicao->nome); ?>

                                  </div>
                                  <div class="col-md-2">
                                    <?php echo e($refeicao->descricao); ?>

                                  </div>
                                  <div class="col-md-2">

                                    <?php
                                        $cardapio_refeicao = \App\cardapio_diario_refeicao::where('refeicao_id', '=', $refeicao->id)
                                                                                ->where('cardapio_diario_id', '=', $cardapio_diario->id)
                                                                                ->first();
                                        if(empty($cardapio_refeicao)){ ?>
                                          <button class="btn btn-success" type="submit">+</button>
                                      <?php } else { ?>
                                        <a class="btn btn-danger" href="/cardapio/removerItem/<?php echo e($cardapio_refeicao->id); ?>">
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
                      <center><a class="btn btn-primary" href="/cardapioDiario/finalizarCardapio/<?php echo e($cardapio_mensal->id); ?>">Concluir</a></center>
                  </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/InserirRefeicaoCardapio.blade.php ENDPATH**/ ?>