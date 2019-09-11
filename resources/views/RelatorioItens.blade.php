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
                <td align="center" colspan=3><h1 size="80">ITENS</h1></td>
            </tr>
        </table>
        <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633"width="100%" class="table table-hover">
            <thead>
            <tr bgcolor="#B0E0E6" colspan=3 align="center"><font size="20px">
                <th>Id</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Unidade</th>
                <th>Gramatura</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($itens as $item)
                <tr>
                    <td bgcolor="#dfdfdf" data-title="Id">{{ $item->id }}</td>
                    <td data-title="Nome">{{ $item->nome }}</td>
                    <td data-title="Descrição">{{ $item->descricao }}</td>
                    <td data-title="Unidade">{{ $item->unidade }}</td>
                    <td data-title="Gramatura">{{ $item->gramatura }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>