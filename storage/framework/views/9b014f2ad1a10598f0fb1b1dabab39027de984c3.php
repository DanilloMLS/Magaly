<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Inserir Item no Estoque')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('/estoque/novoItem')); ?>">
                      <?php echo e(csrf_field()); ?>

                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="estoque_id" value="<?php echo e($estoque->id); ?>" />

                        <div class="form-group row">
                            <label for="item_id" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Item')); ?></label>
                            <?php if(count($itens) != 0 and count($itens_contrato) != 0 and count($contratos)): ?>
                            <div class="col-md-6">
                              <select class="form-control" id="itens" name="item_id" required>
      								              <option value="">Selecione um Item</option>
                                    <?php $__currentLoopData = $itens_contrato; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php
                                          $item = \App\Item::find($item_contrato->item_id);
                                          $contrato = \App\Contrato::find($item_contrato->contrato_id);
                                          $fornecedor = \App\Fornecedor::find($contrato->fornecedor_id);
                                      ?>
      									              <option value="<?php echo e($item_contrato->item_id); ?>"><?php echo e($item->nome); ?> - <?php echo e($item->gramatura); ?><?php echo e($item->unidade); ?> - <?php echo e($fornecedor->nome); ?> - Contrato Nº <?php echo e($contrato->n_contrato); ?></option>
      								              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                            <?php else: ?>
                            <div class="col-md-6">
                              <select class="form-control" id="itens" name="item_id" required>
      								              <option value="">Não há itens cadastrados</option>
                              </select>
                            </div>
                            <?php endif; ?>
                         </div>

                        <div class="form-group row">
                            <label for="quantidade" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Quantidade')); ?></label>

                            <div class="col-md-6">
                              <input name="quantidade" id="quantidade" type="number" pattern="[0-9]*" min="0" class="form-control" required value= <?php echo e(old('quantidade')); ?>> <?php echo e($errors->first('quantidade')); ?></input>

                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="quantidade_danificados" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Quantidade danificados')); ?></label>

                            <div class="col-md-6">
                              <input name="quantidade_danificados" id="quantidade_danificados" type="number" pattern="[0-9]*" min="0" class="form-control" required value= <?php echo e(old('quantidade_danificados')); ?>> <?php echo e($errors->first('quantidade_danificados')); ?></input>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Inserir no Estoque
                              </button>
                            <a class="btn btn-primary" href="/estoque/exibirItensEstoque/+<?php echo e($estoque->id); ?>">Finalizar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/InserirNovoItemEstoque.blade.php ENDPATH**/ ?>