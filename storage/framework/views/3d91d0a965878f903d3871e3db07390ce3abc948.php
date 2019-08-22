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
            <tr align="">
                <td align="center" colspan=3><h1 size="80">RELATÓRIO DE FORNECEDORES</h1></td>
            </tr>
        </table>
        <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633"width="100%" class="table table-hover">
            <thead>
              <tr bgcolor="#F4A460" colspan=3 align="center"><font size="20px">
                  <th>ID</th>
                  <th>NOME</th>
                  <th>CNPJ</th>
                  <th>E-MAIL</th>
                  <th>TELEFONE</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $fornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr bgcolor="#dfdfdf">
                    <td data-title="Id" align="center"><?php echo e($fornecedor->id); ?></td>
                    <td data-title="Nome" align="center"><?php echo e($fornecedor->nome); ?></td>
                    <td data-title="Descrição" align="center"><?php echo e($fornecedor->cnpj); ?></td>
                    <td data-title="E-mail" align="center"><?php echo e($fornecedor->email); ?></td>
                    <td data-title="Telefone" align="center"><?php echo e($fornecedor->telefone); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
    </body>
</html>
<?php /**PATH /home/jsouza/Dropbox/Projetos/Seduc/Magaly/resources/views/RelatorioFornecedores.blade.php ENDPATH**/ ?>