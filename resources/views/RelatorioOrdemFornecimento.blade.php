<html>
    <head>
        <title>Impressão Ordem de Fornecimento</title>
        <style type="text/css">
            .footer {
                position:absolute;
                bottom:0;
                width:100%;
            }

            .itens{
                font-size: 10px;
            }

            .cabecalho-itens{
                font-size: 13px;
            }
            </style>

        <?php 
        function extenso($value, $uppercase = 0)
{
    if (strpos($value, ",") > 0) {
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
    }
    $singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"];
    $plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões"];
 
    $c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
    $d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
    $d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];
    $u = ["", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove"];
 
    $z = 0;
 
    $value = number_format($value, 2, ".", ".");
    $integer = explode(".", $value);
    $cont = count($integer);
    for ($i = 0; $i < $cont; $i++)
        for ($ii = strlen($integer[$i]); $ii < 3; $ii++)
            $integer[$i] = "0" . $integer[$i];
 
    $fim = $cont - ($integer[$cont - 1] > 0 ? 1 : 2);
    $rt = '';
    for ($i = 0; $i < $cont; $i++) {
        $value = $integer[$i];
        $rc = (($value > 100) && ($value < 200)) ? "cento" : $c[$value[0]];
        $rd = ($value[1] < 2) ? "" : $d[$value[1]];
        $ru = ($value > 0) ? (($value[1] == 1) ? $d10[$value[2]] : $u[$value[2]]) : "";
 
        $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                $ru) ? " e " : "") . $ru;
        $t = $cont - 1 - $i;
        $r .= $r ? " " . ($value > 1 ? $plural[$t] : $singular[$t]) : "";
        if ($value == "000"
        )
            $z++;
        elseif ($z > 0)
            $z--;
        if (($t == 1) && ($z > 0) && ($integer[0] > 0))
            $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
        if ($r)
            $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                    ($integer[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }
 
    if (!$uppercase) {
        return trim($rt ? $rt : "zero");
    } elseif ($uppercase == "2") {
        return trim(strtoupper($rt) ? strtoupper(strtoupper($rt)) : "Zero");
    } else {
        return trim(ucwords($rt) ? ucwords($rt) : "Zero");
    }
}

function data_extensa(){
    $meses = ["JANEIRO","FEVEREIRO","MARÇO","ABRIL","MAIO","JUNHO","JULHO","AGOSTO","SETEMBRO","OUTUBRO","NOVEMBRO","DEZEMBRO"];
    return "GARANHUNS, ".date('d')." DE ".$meses[date('m')-1]." DE ".date("Y");
}
            ?>
    </head>
    <body>
        <table width="100%">
            <tr>
                <td align="center">
                    <img id="logo" src="./img/logo.png" width="80" alt="Logo">
                </td>
                <td>
                    <font size="13px">
                    <pre align="center">
Secretaria Municipal de Educação</br>
Rua: Siqueira Campos, 75 - Garanhuns PE</br>
Tel: (87)3762-7060
                    </pre>
                </font>
                </td>
                <td>
                    <img id="alimentacao" src="./img/alimentacao.png" width="160" alt="Alimentacao">
                </td>
            </tr>
            <br>
        </table>
            <div class="cabecalho">
                <p class="cabecalho-titulo" align="center">
                    <font size="20px"><b>ORDEM DE FORNECIMENTO<br>Nº <?php echo $num_ordem?><font color="red" size="20px"></font></b></font>
                </p>
                <p class="cabecalho-nota" align="justify">
                    <font size="13px">Pelo presente, autorizo a Empresa <b>{{$fornecedor->nome}}</b> vencedora do processo licitatório nº <b>{{$contrato_ordem->n_processo_licitatorio}}</b>,
                        modalidade <b>{{$contrato_ordem->modalidade}}</b>, destinados ao preparo de merenda instituicaor para os alunos de Rede Municipal
                        de Ensino deste Município, conforme especificações, quantidades e demais condições previstas no Contrato nº <b>{{$contrato_ordem->n_contrato}}</b></font>
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
                    <tr bgcolor="#B0E0E6" colspan=3 align="center"><font size="20px">
                        <td class="cabecalho-itens"><b>Nº</b></td>
                        <td class="cabecalho-itens"><b>ITEM</b></td>
                        <td class="cabecalho-itens"><b>UNIDADE</b></td>
                        <td class="cabecalho-itens"><b>MARCA</b></td>
                        <td class="cabecalho-itens"><b>Qtid. TOTAL</b></td>
                        <td class="cabecalho-itens"><b>VALOR UNIT.</b></td>
                        <td class="cabecalho-itens"><b>VALOR TOT.</b></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $cont = 0;
                    @endphp
                    @foreach ($ordem_itens as $ordem_item)                                   
                        @php         
                            $cont++;
                            $item_contrato = \App\Contrato_item::where('id', $ordem_item->contratoitem_id)->first();
                            $item = \App\Item::where('id', $item_contrato->item_id)->first();

                            $unidade = $item->unidade;
                            if($item->gramatura >= 1000000){
                                $unidade = "TON";
                            }else if($item->gramatura >= 1000){
                                $unidade = "KG";
                            }
                        @endphp
                        <tr>
                            <td class="itens" bgcolor="#dfdfdf" data-title="Nº" align="center">{{ $cont }}</td>
                            <td class="itens" data-title="Descricao" align="justify">{{ $item->descricao }}</td>
                            <td class="itens" data-title="Unidade" align="center">{{  $unidade }}</td>
                            <td class="itens" data-title="Gramatura" align="center">{{ $item->marca }}</td>
                            <td class="itens" data-title="Quantidade" align="center">{{ $ordem_item->quantidade_pedida }}</td>
                            <td class="itens" data-title="ValorUnitario" align="center">{{ "R$ ". number_format($item_contrato->valor_unitario,2,",",".") }}</td>
                            <td class="itens" data-title="Valor_Total" align="center">{{ "R$ ". number_format($ordem_item->quantidade_pedida * $item_contrato->valor_unitario,2,",",".") }}</td>
                            <?php $total += $ordem_item->quantidade_pedida * $item_contrato->valor_unitario?>
                        </tr>
                    @endforeach
                    <tr align="center"><font size="20px">
                        <td class="itens" colspan=6 data-title="TOTAL" align="center">{{ "TOTAL"}}</td>
                        <td class="itens" data-title="SOMATORIO_TOTAL">{{ "R$ ". number_format($total,2,",",".") }}</td>
                    </tr>
                    <tr align="center">
                        <td colspan=7><font size="10px"><?php echo "VALOR R$".number_format($total,2,",",".")." (".strtoupper(extenso($total, 1).")")?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <>
            <div class="observacao-ordem-fornecimento">
                <p align="justify"><font size="13px">
                    <?php echo "OBS:. ".$ordem_Fornecimento->observacao?>
                </font></p>
                <br>
                <p align="right"><font size="13px" color="red">
                    <?php echo data_extensa()?>
                </font>
                </p>
            </div>
            <div class="footer">
            <p align="center"><font size="13px">                
                <?php echo "______________________________________________________________________________"?>
                <br>
                <br>
                <?php echo "INGRID FERNANDA DE LIMA FERREIRA TENÓRIO" ?>
                <br>
                <?php echo "MATRÍCULA - 14502" ?>
                <br>
                <?php echo "GERENTE DE ALIMENTAÇÃO" ?>
            </p>
            </div>
    </body>
</html>