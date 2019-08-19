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
            <hr>
            <tr align="">
                <td align="center" colspan=3><h1 size="80">Escolas</h1></td>
            </tr>
        </table>
        <table width="100%" class="table table-hover">
        <thead>
          <tr>
              <th>Nome</th>
              <th>Modalidade de Ensino</th>
              <th>Rota</th>
              <th>Endereço</th>
              <th>Período de Atendimento</th>
              <th>Quantidade de Alunos</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $escolas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $escola): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td data-title="Nome"><?php echo e($escola->nome); ?></td>
                <td data-title="Modalidade de Ensino"><?php echo e($escola->modalidade_ensino); ?></td>
                <td data-title="Rota"><?php echo e($escola->rota); ?></td>
                <td data-title="Endereco"><?php echo e($escola->endereco); ?></td>
                <td data-title="Período de Atendimento"><?php echo e($escola->periodo_atendimento); ?></td>
                <td data-title="Quantidade de Alunos"><?php echo e($escola->qtde_alunos); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </body>
</html><?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/RelatorioEscolas.blade.php ENDPATH**/ ?>