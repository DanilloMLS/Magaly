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
        </table>
        <br>
        <br>
        <p align="center">
            <font size="20px"><b>PROGRAMA NACIONAL DE ALIMENTAÇÃO ESCOLAR - PNAE<br>GRR - GUIA DE RECEBIMENTO E REMESSA</b></font>
        </p>
        <br>
        <b>DATA:____/____/20____</b>
        <?php $__currentLoopData = $distribuicoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distribuicao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633">
                <tr>
                    <th bgcolor="#00CED1" colspan=3 align="center"><font size="20px">IDENTIFICAÇÃO DA ESCOLA</font></th>
                </tr>
                <tr bgcolor="#dfdfdf">
                    <th>ESCOLA</th>
                    <th>ROTA</th>
                    <th>MODALIDADE DE ENSINO</th>
                </tr>
                <tbody>
                    <tr>
                        <?php $escola = \App\Escola::find($distribuicao->escola_id)?>
                        <td data-title="Nome"><?php echo e($escola->nome); ?></td>
                        <td data-title="Rota"><?php echo e($escola->rota); ?></td>
                        <td data-title="Modalidade de Ensino"><?php echo e($escola->modalidade_ensino); ?></td>
                    </tr>
                </tbody>
                <tr bgcolor="#dfdfdf">
                    <th>PERÍODO DE ATENDIMENTO</th>
                    <th colspan=2>OBSERVAÇÃO</th>
                </tr>
                <tbody>
                <tr>
                    <td data-title="Periodo de Atendimento"><?php echo e($escola->periodo_atendimento); ?></td>
                    <td colspan=3 data-title="Observação"><?php echo e($distribuicao->observacao); ?></td>
                </tr>
                </tbody>
            </table>
            <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633">
                <tr>
                    <th bgcolor="#00CED1" colspan=5 align="center"><font size="20px">ESPECIFICAÇÃO E DISTRIBUIÇÃO DOS GÊNEROS ALIMENTÍCIOS</font></th>
                </tr>
                <tbody>
                    <tr align="center">
                        <th bgcolor="#dfdfdf">ID</th>
                        <th>ITEM</th>
                        <th>UNIDADE</th>
                        <th>QUANTIDADE</th>
                        <th>FALTAS</th>
                        <th>DATA DA ENTREGA DA FALTA E ASSINATURA</th>
                    </tr>
                    <?php $__currentLoopData = \App\Distribuicao_item::where('distribuicao_id', '=', $distribuicao->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_distribuicao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php
                                $item = \App\Item::find($item_distribuicao->item_id);
                            ?>
                            <td data-title="Id"><?php echo e($item->id); ?></td>
                            <td data-title="Nome"><?php echo e($item->nome); ?></td>
                            <td data-title="Unidade" align="center"><?php echo e($item->gramatura . "" . $item->unidade); ?></td>
                            <td data-title="Quantidade" align="center"><?php echo e($item_distribuicao->quantidade); ?></td>
                            <td></td>
                            <td></td>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <br>
        <p style="text-align:justify;">
            <b aligh="justify">Sr. Gestor, solicito que ao receber as mercadorias acima descriminadas, conferir quantidade e qualidade dos produtos,
                após atestar o recebimento, o senhor(a) está dando plena e irrevogável quitação da quantidade e qualidade dos produtos recebidos.</b>
        </p>
        <br>
        <table style="text-align:center;" width="100%">
            <tr>
                <td >_______________________________________</td>
                <td>________________________________________</td>
            </tr>
            <tr >
                <td><b>RESPONSÁVEL PELA ENTREGA</b></td>
                <td><b>RESPONSÁVEL PELO RECEBIMENTO</b></td>
            </tr>
        </table>
    </body>
</html>
<?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/RelatorioDistribuicoes.blade.php ENDPATH**/ ?>