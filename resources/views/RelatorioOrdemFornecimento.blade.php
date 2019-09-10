<html>
<head>

</head>
<body>
<table width="100%">
    <tr>
        <td align="center">
            <img id="logo" src="./img/logo.png" width="80" alt="Logo">
        </td>
        <td><pre>
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
</table>
<br>
<br>
@foreach ($contratos as $contrato)
    <p align="center" colspan=3><font size="20px"><b>ORDEM DE FORNECIMENTO <br> Nº <font color="red"> # numero da ordem #</font></br></font></p>
    <p align="justify"><font size="10px">Pelo presente, autorizo a Empresa <b>#NOME_EMPRESA#</b> vencedora do processo licitatório
            <b>#nº processo#</b>, modalidade <b>#modalidade# nº #num_modalidade#</b>, destinados ao preparo de merenda escolar para os
            alunos da Rede Municipal de Ensino deste Município, conforme especificações, quantidades e demais condições previstas no
            <b>Contrato nº #num_contrato#</b>
        </font></p>

    <p>
        <font size="14px">EMPRESA: <b>#Nome da Empersa#</b><br>CNPJ: <b>#cnpj_empresa#</b></font>
    </p>

    <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633">
        <thead>
        <tr>
            <td bgcolor="#dfdfdf"><b>Nº</b></td>
            <td><b>Contrato</b></td>
            <td><b>Fornecedor</b></td>
            <td><b>Processo</b></td>
            <td><b>Data</b></td>
            <td><b>Total</b></td>

            <td><b>Item</b></td>
            <td><b>Lote</b></td>
            <td><b>Unidade</b></td>
            <td><b>Gramatura</b></td>
            <td><b>Quantidade</b></td>
            <td><b>Unitário</b></td>
        </tr>
        </thead>
        <tbody>
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
    </div>
</body>
</html>
