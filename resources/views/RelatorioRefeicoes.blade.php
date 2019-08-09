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
                <td align="center" colspan=3><h1 size="80">Fornecedores</h1></td>
            </tr>
        </table>
        <table width="100%" class="table table-hover">
        <thead>
          <tr>
              <th>Nome</th>
              <th>Descrição</th>
              <th>Peso líquido</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($refeicoes as $refeicao)
            <tr>
                <td data-title="Nome">{{ $refeicao->nome }}</td>
                <td data-title="Descricao">{{ $refeicao->descricao }}</td>
                <td data-title="Peso_liquido">{{ $refeicao->peso_liquido }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </body>
</html>
