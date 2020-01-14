<html>
    <head>
        <title> Listagem de Ítens de contratos por Fornecedor</title>
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
                    echo "<p>".date("d")."/".date("m")."/".date("Y"). "</p>";
                    ?>
                </td>
            </tr>
        </table>
        @foreach ($contratos as $contrato)
            <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633">
                <tr>
                    <th bgcolor="#B0E0E6" colspan=4 align="center"><font size="20px">IDENTIFICAÇÃO DA CONTRATO</font></th>
                </tr>
                <tr bgcolor="#dfdfdf">
                    <th>CONTRATO</th>
                    <th>PROCESSO LICITATÓRIO</th>
                    <th colspan=2 >MODALIDADE</th>
                </tr>
                <tbody>
                    <tr>
                        <td data-title="n_contrato">{{ $contrato->n_contrato}}</td>
                        <td data-title="n_processo_licitatorio">{{ $contrato->n_processo_licitatorio}}</td>
                        <td colspan=2 data-title="Modalidade">{{ $contrato->modalidade}}</td>
                    </tr>
                </tbody>
                <tr bgcolor="#dfdfdf">
                    <th>FORNECEDOR</th>
                    <th colspan=3>DESCRIÇÃO</th>
                </tr>
                <tbody>
                <tr>
                <?php $fornecedor = \App\Fornecedor::where('id',$contrato->fornecedor_id)->first()?>                
                <td data-title="Nome_Fornecedor">{{ $fornecedor->nome }}</td>
                    <td colspan=3 data-title="Observação">{{ $contrato->descricao }}</td>
                </tr>
                </tbody>
            </table>
            <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633">
                <tr>
                    <th bgcolor="#B0E0E6" colspan=4 align="center"><font size="20px">ÍTENS DO CONTRATO</font></th>
                </tr>
                <tbody>
                    <tr align="center" bgcolor="#dfdfdf">
                        <th>ID</th>
                        <th>DESCRIÇÃO</th>
                        <th>MARCA</th>
                        <th>GRAMATURA</th>
                    </tr>

                    @foreach (\App\Contrato_item::where('contrato_id', $contrato->id)->get() as $item_contratos)
                        <tr>
                            @php
                                $item = \App\Item::find($item_contratos->item_id);
                            @endphp
                            <td data-title="Id" align="center">{{ $item->id }}</td>
                            <td width="70%" align="justify" data-title="Descricao">{{ $item->nome." - ".$item->descricao }}</td>
                            <td data-title="Marca" align="center">{{$item->marca }}</td>
                            <td data-title="Gramatura" align="center">{{ $item->gramatura." ".$item->unidade }}</td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <br>
        @endforeach
    </body>
</html>
