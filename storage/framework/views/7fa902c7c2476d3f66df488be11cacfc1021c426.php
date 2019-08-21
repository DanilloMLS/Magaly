<html>
    <head>

    </head>
    <body>
        <table width="100%">
            <tr>
                <td align="center">
                    <img id="logo" src="./img/logo.png" width="80" alt="Logo">
                </td>
                <td>
                    <pre align="center">
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
            <tr align="">
                <td align="center" colspan=3><h1 size="80">LISTAGEM DAS ESCOLAS</h1></td>
            </tr>
        </table>
        <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633"width="100%" class="table table-hover">
        <thead>
          <tr bgcolor="#F4A460" colspan=3 align="center"><font size="20px">
              <th>Nº</th>
              <th>NOME</th>
              <th>MODALIDADE</th>
              <th>ROTA</th>
              <th>ENDEREÇO</th>
              <th>ATENDIMENTO</th>
              <th>ALUNOS</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $escolas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $escola): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr bgcolor="#dfdfdf">
                <td data-title="nº" align="center"><?php echo e($escola->id); ?></td>
                <td data-title="Nome" align="center"><?php echo e($escola->nome); ?></td>
                <td data-title="Modalidade de Ensino" align="center"><?php echo e($escola->modalidade_ensino); ?></td>
                <td data-title="Rota" align="center"><?php echo e($escola->rota); ?></td>
                <td data-title="Endereco" align="center"><?php echo e($escola->endereco); ?></td>
                <td data-title="Período de Atendimento" align="center"><?php echo e($escola->periodo_atendimento); ?></td>
                <td data-title="Quantidade de Alunos" align="center"><?php echo e($escola->qtde_alunos); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </body>
</html><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/RelatorioEscolas.blade.php ENDPATH**/ ?>