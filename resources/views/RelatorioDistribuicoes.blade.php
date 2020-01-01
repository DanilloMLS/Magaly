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
                <td >
                @foreach ($distribuicoes as $distribuicao)
                <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(150)->generate("
                    $url
                    ")) !!} ">
                @endforeach
                </td>
            </tr>
        </table>
        <br>
        <br>
        <p align="center">
            <font size="20px"><b>PROGRAMA NACIONAL DE ALIMENTAÇÃO ESCOLAR - PNAE<br>GRR - GUIA DE RECEBIMENTO E REMESSA</b></font>
        </p>
        <br>
        <b>DATA:____/____/20____</b>
        @foreach ($distribuicoes as $distribuicao)
            <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633">
                <tr>
                    <th bgcolor="#B0E0E6" colspan=4 align="center"><font size="20px">IDENTIFICAÇÃO DA ESCOLA</font></th>
                </tr>
                <tr bgcolor="#dfdfdf">
                    <th>ESCOLA</th>
                    <th>ROTA</th>
                    <th colspan=2 >MODALIDADE DE ENSINO</th>
                </tr>
                <tbody>
                    <tr>
                        <?php $escola = \App\Escola::find($distribuicao->escola_id)?>
                        <td data-title="Nome">{{ $escola->nome}}</td>
                        <td data-title="Rota">{{ $escola->rota}}</td>
                        <td colspan=2 data-title="Modalidade de Ensino">{{ $escola->modalidade_ensino}}</td>
                    </tr>
                </tbody>
                <tr bgcolor="#dfdfdf">
                    <th>PERÍODO DE ATENDIMENTO</th>
                    <th colspan=3>OBSERVAÇÃO</th>
                </tr>
                <tbody>
                <tr>
                    <td data-title="Periodo de Atendimento">{{ $escola->periodo_atendimento}}</td>
                    <td colspan=3 data-title="Observação">{{ $distribuicao->observacao }}</td>
                </tr>
                </tbody>
            </table>
            <table width="100%" class="table table-hover" border=1 cellspacing=0 cellpadding=0 bordercolor="666633">
                <tr>
                    <th bgcolor="#B0E0E6" colspan=6 align="center"><font size="20px">ESPECIFICAÇÃO E DISTRIBUIÇÃO DOS GÊNEROS ALIMENTÍCIOS</font></th>
                </tr>
                <tbody>
                    <tr align="center" bgcolor="#dfdfdf">
                        <th>ID</th>
                        <th>ITEM</th>
                        <th>UNIDADE</th>
                        <th>QUANTIDADE</th>
                        <th>FALTAS</th>
                        <th>DATA e ASSINATURA</th>
                    </tr>
                    @foreach (\App\Distribuicao_item::where('distribuicao_id', '=', $distribuicao->id)->get() as $item_distribuicao)
                        <tr>
                            @php
                                $item = \App\Item::find($item_distribuicao->item_id);
                            @endphp
                            <td data-title="Id">{{ $item->id }}</td>
                            <td width="25%" data-title="Nome">{{ $item->nome }}</td>
                            <td data-title="Unidade" align="center">{{$item->gramatura . "" . $item->unidade }}</td>
                            <td data-title="Quantidade" align="center">{{ $item_distribuicao->quantidade_total }}</td>
                            <td data-title="Qtde. Falta">{{ $item_distribuicao->quantidade_falta }}</td>
                            <td></td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
        <br>
        <p style="text-align:justify;">
            <b aligh="justify">Sr. Gestor, solicito que ao receber as mercadorias acima descriminadas, conferir quantidade e qualidade dos produtos,
                após atestar o recebimento, o senhor(a) está dando plena e irrevogável quitação da quantidade e qualidade dos produtos recebidos.</b>
        </p>
        <br>
        <table style="text-align:center;" width="100%">
            <tr>
                <td >_______________________________________</td>
                <td>________________________________________</td>
            </tr>
            <tr >
                <td><b>RESPONSÁVEL PELA ENTREGA</b></td>
                <td><b>RESPONSÁVEL PELO RECEBIMENTO</b></td>
            </tr>
        </table>
    </body>
</html>
