<html>
    <head>

    </head>
    <body>
        <table width="100%">
            <tr>
                <td align="center">
                    <img id="logo" src="./img/logo.png" width="80" alt="Logo">
                </td>
                <td><pre align="center">
Secretaria Municipal de Educação</br>
Rua: Siqueira Campos, 75 - Garanhuns PE</br>
Tel: (87)3762-7060
                    </pre>
                </td>
                <td>
                    <?php
                    echo "<p>".date("H").":".date("i").":".date("s"). "</p>";
                    echo "<p>".date("d")."/".date("m")."/".date("y"). "</p>";
                    ?>
                </td>
            </tr>
            <hr>
            <tr align="">
                <td align="center" colspan=3><h1 size="80">Estoques</h1></td>
            </tr>
        </table>
        <table width="100%" class="table table-hover">
            <tbody>
                <tr>
                    <th>Estoque</th>
                    <th>Item</th>
                    <th>Data de validade</th>
                    <th>Nº lote</th>
                    <th>Unidade</th>
                    <th>Gramatura</th>
                    <th>Descrição</th>
                </tr>
                <?php $__currentLoopData = $estoques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estoque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php $__currentLoopData = \App\Estoque_item::where('estoque_id', '=', $estoque->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_estoque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                          $item = \App\Item::find($item_estoque->item_id);
                      ?>
                      <tr>
                          <td data-title="Nome"><?php echo e($estoque->nome); ?></td>
                          <td data-title="Valor unitário"><?php echo e($item->nome); ?></td>
                          <td data-title="Data de validade"><?php echo e($item->data_validade); ?></td>
                          <td data-title="Nº lote"><?php echo e($item->n_lote); ?></td>
                          <td data-title="Unidade"><?php echo e($item->unidade); ?></td>
                          <td data-title="Gramatura"><?php echo e($item->gramatura); ?></td>
                          <td data-title="Descrição"><?php echo e($item->descricao); ?></td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </body>
</html><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/RelatorioEstoques.blade.php ENDPATH**/ ?>