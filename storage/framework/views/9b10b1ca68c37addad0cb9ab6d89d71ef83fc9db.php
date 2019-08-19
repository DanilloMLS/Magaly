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
            <br>
        </table>
        <div class="cabecalho">
            <p class="cabecalho-titulo" align="center">
                <font size="20px"><b>ORDEM DE FORNECIMENTO<br>Nº <font color="red" size="20px">#Num_ordem_fornecimento#</font></b></font>
            </p>
            <p class="cabecalho-nota" align="justify">
                <font size="11px">Pelo presente, autorizo a Empresa <b>#nome_empresa#</b> vencedora do processo licitatório nº <b>#num_proc_lic#</b>,
                    modalidade #modalidade_numero#, destinados ao preparo de merenda escolar oara os alunos de Rede Municipal
                    de Ensino deste Município, conforme especificações, quantidades e demais condições previstas no Contrato nº <b>#num_contrat#</b></font>
            </p>
            <p class="cabecalho-empresa">
                <font size="12px">
                    EMPRESA: <b>#nome_empresa#</b><br>
                    CNPJ: <b>#CNPJ_empresa#</b>
                </font>
            </p>
        </div>
        <table width="100%" class="table table-hover">
            <thead>
            <tr bgcolor="#eee">
                <hr>
                <td><b>Nº</b></td>
                <td><b>ITEM</b></td>
                <td><b>UNIDADE</b></td>
                <td><b>MARCA</b></td>
                <td><b>Qtid. TOTAL</b></td>

                <td><b>VALOR UNIT.</b></td>
                <td><b>VALOR TOT.</b></td>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $contratos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php $fornecedor = \App\Fornecedor::find($contrato->fornecedor_id)?>
                    <td data-title="N_contrato"><?php echo e($contrato->n_contrato); ?></td>
                    <td data-title="Fornecedor"><?php echo e($fornecedor->nome); ?></td>
                    <td data-title="N_processo"><?php echo e($contrato->n_processo_licitatorio); ?></td>
                    <td data-title="Data"><?php echo e($contrato->data); ?></td>
                    <td data-title="valor_total"><?php echo e($contrato->valor_total); ?></td>
                    <?php $__currentLoopData = \App\Contrato_item::where('contrato_id', '=', $contrato->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $item = \App\Item::find($item_contrato->item_id);
                        ?>
                        <td data-title="Valor unitário"><?php echo e($item->nome); ?></td>
                        <td data-title="Nº lote"><?php echo e($item->n_lote); ?></td>
                        <td data-title="Unidade"><?php echo e($item->unidade); ?></td>
                        <td data-title="Gramatura"><?php echo e($item->gramatura); ?></td>
                        <td data-title="Quantidade"><?php echo e($item_contrato->quantidade); ?></td>
                        <td data-title="ValorUnitario"><?php echo e($item_contrato->valor_unitario); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </body>
</html><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/RelatorioContratos.blade.php ENDPATH**/ ?>