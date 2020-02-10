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
                <td align="center" colspan=3><h1 size="80">INSTITUIÇÕES</h1></td>
            </tr>
        </table>
        <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633"width="100%" class="table table-hover">
        <thead>
          <tr bgcolor="#B0E0E6" colspan=3 align="center"><font size="20px">
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
          @foreach ($instituicaos as $instituicao)
            <tr>
                <td bgcolor="#dfdfdf" data-title="nº" align="center">{{ $instituicao->id }}</td>
                <td data-title="Nome" align="center">{{ $instituicao->nome }}</td>
                <td data-title="Modalidade de Ensino" align="center">{{ $instituicao->modalidade_ensino }}</td>
                <td data-title="Rota" align="center">{{ $instituicao->rota }}</td>
                <td data-title="Endereco" align="center">{{ $instituicao->endereco }}</td>
                <td data-title="Período de Atendimento" align="center">{{ $instituicao->periodo_atendimento }}</td>
                <td data-title="Quantidade de Alunos" align="center">{{ $instituicao->qtde_alunos }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </body>
</html>