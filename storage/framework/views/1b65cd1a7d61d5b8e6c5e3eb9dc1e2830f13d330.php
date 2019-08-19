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
                <td align="center" colspan=3><h1 size="80">Itens</h1></td>
            </tr>
        </table>
        <table width="100%" class="table table-hover">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Data de validade</th>
                <th>Nº lote</th>
                <th>Descrição</th>
                <th>Unidade</th>
                <th>Gramatura</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $itens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <colgroup>
                    <tr>
                        <td data-title="Valor unitário"><?php echo e($item->nome); ?></td>
                        <td data-title="Data de validade"><?php echo e($item->data_validade); ?></td>
                        <td data-title="Nº lote"><?php echo e($item->n_lote); ?></td>
                        <td data-title="Descrição"><?php echo e($item->descricao); ?></td>
                        <td data-title="Unidade"><?php echo e($item->unidade); ?></td>
                        <td data-title="Gramatura"><?php echo e($item->gramatura); ?></td>
                    </tr>
                </colgroup>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </body>
</html><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/RelatorioItens.blade.php ENDPATH**/ ?>