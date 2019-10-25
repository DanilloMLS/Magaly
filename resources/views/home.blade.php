@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChart2);
        google.charts.setOnLoadCallback(drawChart3);
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
                legend: { position: "none" }
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));

            chart.draw(data2, options);
        }

        function drawChart3() {
            var style = { role: "style" };
            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Topping');
            data3.addColumn('number', 'Slices');
            data3.addColumn({type:'string', role: 'style' });
            data3.addRows(<?= json_encode($data03)?>);
            var options = {
                title: 'Ítens no estoque',
                legend: { position: "none" },
                name: {position: 'none'}
            };
            var chart = new google.visualization.BarChart(document.getElementById('chart_div3'));

            chart.draw(data3, options);
        }
    </script>

    <div class="container">
        <div class="row justify-content-center">

            @if (Auth::guard()->check() && Auth::user()->is_adm)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <center><strong>Contratos</strong><center>
                        </div>
                        <a href="{{route('/contrato/listar_Falta')}}" >
                            <div id="chart_div" class="chart_div"></div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <center><strong>{{$nome_ref}}</strong><center>
                        </div>
                        <a href="{{route("/refeicao/listar")}}" >
                            <div id="chart_div2" class="chart_div"></div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <center><strong>{{$nome_stq}}</strong><center>
                        </div>
                        <a href="{{route("/estoque/listar")}}" >
                            <div id="chart_div3" class="chart_div"></div>
                        </a>
                    </div>
                </div>
                <div class="sobre-magaly-home">
                    <br>
                    <div class="card">
                        <div class="card-header"><h3 align="center">Sistema Magaly</h3>
                        </div>

                        <div class="card-body">
                            <div class="panel-body">
                                <p align="justify">
                                    O Sistema de Gestão Alimentar <strong>Magaly</strong> tem como objetivo facilitar as atividades de gerenciamento da merenda escolar, permitindo de forma simples o controle de estoque, de distribuições, a criação de refeições e cardápios e o acesso rápido aos dados cadastrados no sistema.
                                    <br><br>
                                    seducdivtecnologia@gmail.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-7">
                    <br>
                    <div class="card">
                        <div class="card-header"><h3 align="center">Sistema Magaly</h3>
                        </div>

                        <div class="card-body">
                            <div class="panel-body">
                                <p align="justify">
                                    O Sistema de Gestão Alimentar <strong>Magaly</strong> tem como objetivo facilitar as atividades de gerenciamento da merenda escolar, permitindo de forma simples o controle de estoque, de distribuições, a criação de refeições e cardápios e o acesso rápido aos dados cadastrados no sistema.
                                    <br><br>
                                    seducdivtecnologia@gmail.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
