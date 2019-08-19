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
        <div class="cabecalho">
            <p class="cabecalho-titulo" align="center">
                <font size="20px"><b>ORDEM DE FORNECIMENTO<br>Nº <font color="red" size="20px">#Num_ordem_fornecimento#</font></b></font>
            </p>
            <p class="cabecalho-nota" align="justify">
                <font size="11px">Pelo presente, autorizo a Empresa <b>#nome_empresa#</b> vencedora do processo licitatório nº <b>#num_proc_lic#</b>,
                    modalidade #modalidade_numero#, destinados ao preparo de merenda escolar oara os alunos de Rede Municipal
                    de Ensino deste Município, conforme especificações, quantidades e demais condições previstas no Contrato nº <b>#num_contrat#</b></font>
            </p>
            <p class="cabecalho-empresa">
                <font size="12px">
                    EMPRESA: <b>#nome_empresa#</b><br>
                    CNPJ: <b>#CNPJ_empresa#</b>
                </font>
            </p>
        </div>
        <table width="100%" class="table table-hover">
            <thead>
            <tr bgcolor="#eee">
                <hr>
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
            @foreach ($contratos as $contrato)
                <tr>
                    <?php $fornecedor = \App\Fornecedor::find($contrato->fornecedor_id)?>
                    <td data-title="N_contrato">{{ $contrato->n_contrato }}</td>
                    <td data-title="Fornecedor">{{ $fornecedor->nome }}</td>
                    <td data-title="N_processo">{{ $contrato->n_processo_licitatorio }}</td>
                    <td data-title="Data">{{ $contrato->data }}</td>
                    <td data-title="valor_total">{{ $contrato->valor_total }}</td>
                    @foreach (\App\Contrato_item::where('contrato_id', '=', $contrato->id)->get() as $item_contrato)
                        @php
                            $item = \App\Item::find($item_contrato->item_id);
                        @endphp
                        <td data-title="Valor unitário">{{ $item->nome }}</td>
                        <td data-title="Nº lote">{{ $item->n_lote }}</td>
                        <td data-title="Unidade">{{ $item->unidade }}</td>
                        <td data-title="Gramatura">{{ $item->gramatura }}</td>
                        <td data-title="Quantidade">{{ $item_contrato->quantidade }}</td>
                        <td data-title="ValorUnitario">{{ $item_contrato->valor_unitario }}</td>
                </tr>
                @endforeach

                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>