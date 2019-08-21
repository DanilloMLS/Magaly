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
        @foreach ($contratos as $contrato)
            <?php $fornecedor = \App\Fornecedor::find($contrato->fornecedor_id)?>
            <div class="cabecalho">
                <p class="cabecalho-titulo" align="center">
                    <font size="20px"><b>ORDEM DE FORNECIMENTO<br>Nº <font color="red" size="20px">#Num_ordem_fornecimento#</font></b></font>
                </p>
                <p class="cabecalho-nota" align="justify">
                    <font size="11px">Pelo presente, autorizo a Empresa <b>{{$fornecedor->nome}}</b> vencedora do processo licitatório nº <b>{{$contrato->n_processo_licitatorio}}</b>,
                        modalidade <b>{{$contrato->modalidade}}</b>, destinados ao preparo de merenda escolar oara os alunos de Rede Municipal
                        de Ensino deste Município, conforme especificações, quantidades e demais condições previstas no Contrato nº <b>{{$contrato->n_contrato}}</b></font>
                </p>
                <p class="cabecalho-empresa">
                    <font size="12px">
                        EMPRESA: <b>{{$fornecedor->nome}}</b><br>
                        CNPJ: <b>{{$fornecedor->cnpj}}</b>
                    </font>
                </p>
            </div>
            <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633"width="100%" class="table table-hover">
                <thead>
                    <tr bgcolor="#F4A460" colspan=3 align="center"><font size="20px">
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
                    @foreach (\App\Contrato_item::where('contrato_id', '=', $contrato->id)->get() as $item_contrato)
                        @php
                            $item = \App\Item::find($item_contrato->item_id);
                        @endphp
                        <tr bgcolor="#dfdfdf">
                            <td data-title="Nº" align="center">{{ $item->id }}</td>
                            <td data-title="Descricao" align="justify">{{ $item->descricao }}</td>
                            <td data-title="Unidade" align="center">{{ $item->unidade }}</td>
                            <td data-title="Gramatura" align="center">{{ $item->marca }}</td>
                            <td data-title="Quantidade" align="center">{{ $item_contrato->quantidade }}</td>
                            <td data-title="ValorUnitario" align="center">{{ $item_contrato->valor_unitario }}</td>
                            <td data-title="Valor_Total" align="center">{{ $item_contrato->valor_unitario * $item_contrato->quantidade }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </body>
</html>