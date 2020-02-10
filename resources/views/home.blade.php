@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.load('current', {'packages':['table']});
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChart2);
        google.charts.setOnLoadCallback(drawChart4);
        function drawChart() {
            var style = { role: "style" };
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addColumn({type:'string', role: 'style' });
            data.addRows(<?= json_encode($data01)?>);
            var options = {
                title: 'Contratos com menos itens',
                legend: { position: "none" }
            };

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }

        function drawChart2() {
            var style = { role: "style" };
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Topping');
            data2.addColumn('number', 'Slices');
            data2.addRows(<?= json_encode($data02)?>);
            var options = {
                title: 'Porcentagem de itens na refeição',
                is3D: true,
                pieSliceText: 'label'
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));

            chart.draw(data2, options);
        }

        function drawChart4() {
            var style = { role: "style" };
            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Topping');
            data3.addColumn('number', 'Slices');
            data3.addColumn({type:'string', role: 'style' });
            data3.addRows(<?= json_encode($data04)?>);
            var options = {
                title: 'Ítens no estoque',
                legend: { position: "none" }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div4'));

            chart.draw(data3, options);
        }
    </script>

    <div class="container">
        <div class="row justify-content-center">

            @if (Auth::guard()->check() && Auth::user()->tipo_user == 'adm')
                <div class="graphcs col-md-3">
                    <div class="card">
                        <div class="card-modelo2 redireciona card-header" onclick='location.href="{{route('/contrato/listar_Falta')}}"'>
                            <center><strong>Contratos</strong><center>
                        </div>
                        <div id="chart_div" class="chart_div"></div>
                    </div>
                </div>
                <div class="graphcs col-md-3">
                    <div class="card">
                        <div class="card-modelo2 redireciona card-header" onclick='location.href="{{route("/refeicao/listar")}}"'>
                            <center><strong>{{$nome_ref}}</strong><center>
                        </div>
                        <div id="chart_div2" class="chart_div"></div>
                    </div>
                </div>
                <div class="graphcs col-md-3">
                    <div class="card">
                        <div class="card-modelo2 redireciona card-header" onclick='location.href="{{route("/estoque/listar")}}"'>
                            <center><strong>{{$nome_stq}}</strong><center>
                        </div>
                        <div id="chart_div3" class="chart_div">
                            <div id="tabela">
                                <table class="graph-table">
                                    <thead>
                                    <tr align="center">
                                        <th>Nome</th>
                                        <th>Gram.</th>
                                        <th>Quant.</th>
                                        <th>Validade</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data03 as $data)
                                        <tr>
                                            <td width="45%" data-title="Nome">{{ $data[0] }}</td>
                                            <td align="center" data-title="Gramatura">{{ $data[1] }}</td>
                                            <td align="center" data-title="Quantidade">{{ $data[2] }}</td>
                                            <td align="center" data-title="Validade">{{ $data[3] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart_div_est">
                    <br>
                    <div class="card">
                        <div class="card-modelo2 card-header"> <center><strong>{{$nome_stq_cent}} <center/><strong/>
                        </div>
                        <div id="chart_div4" class="chart_div"></div>
                    </div>
                </div>
            @endif
            <div class="sobre-magaly-home">
                <br>
                <div class="card">
                    <div class="card-modelo2 card-header"><center><strong>Sistema Magaly<center/><strong/>
                    </div>

                    <div class="card-body">
                        <div class="panel-body">
                            <p align="justify">
                                O Sistema de Gestão Alimentar <strong>Magaly</strong>
                                tem como objetivo facilitar as atividades de gerenciamento da merenda instituicaor, 
                                permitindo de forma simples o controle de estoque, de distribuições, a criação de 
                                refeições e cardápios e o acesso rápido aos dados cadastrados no sistema.
                                <br><br>
                                seducdivtecnologia@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
