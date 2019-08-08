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
          @foreach ($escolas as $escola)
            <tr>
                <td data-title="Nome">{{ $escola->nome }}</td>
                <td data-title="Modalidade de Ensino">{{ $escola->modalidade_ensino }}</td>
                <td data-title="Rota">{{ $escola->rota }}</td>
                <td data-title="Endereco">{{ $escola->endereco }}</td>
                <td data-title="Período de Atendimento">{{ $escola->periodo_atendimento }}</td>
                <td data-title="Quantidade de Alunos">{{ $escola->qtde_alunos }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </body>
</html>