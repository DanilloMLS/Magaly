@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">

      @if (Auth::guard()->check() && Auth::user()->is_adm)
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><br>
                </div>

                <div class="card-body">
                  <div class="panel-body">
                    <center><strong>Estoque</strong><center>
                    <div id ="img" style="padding-bottom: 5px;"><center>
                      <a href="{{route('/estoque/listar')}}" ><img class="btn-img" src="/img/estoq.png"></a>
                    </center></div>
                    <br>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><br>
                </div>

                <div class="card-body">
                  <div class="panel-body">
                    <center><strong>Cardápio</strong><center>
                    <div id ="img"><center>
                    <a href="{{route('/cardapio/listar')}}" ><img class="btn-img" src="/img/cardap.png"></a>
                    </center></div>
                    <br>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><br>
                </div>

                <div class="card-body">
                  <div class="panel-body">
                    <center><strong>Distribuição</strong><center>
                    <div id ="img" style="padding-bottom: 5px;"><center>
                    <a href="{{route('/distribuicao/listar')}}" ><img class="btn-img" src="/img/distri.png"></a>
                    </center></div>
                    <br>
                  </div>
                </div>
            </div>
        </div>

        <div style="width:1000px">
          <br>
          <br>
            <div class="card">
                <div class="card-header"><center>Sistema Magaly</center>
                </div>

                <div class="card-body">
                  <div class="panel-body">
                    O Sistema de Gestão Alimentar <strong>Magaly</strong> tem como objetivo facilitar as atividades de gerenciamento da merenda escolar, permitindo de forma simples o controle de estoque, de distribuições, a criação de refeições e cardápios e o acesso rápido aos dados cadastrados no sistema.
                    <br><br>
                    seducdivtecnologia@gmail.com
                  </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-7">
          <br>
          <br>
            <div class="card">
                <div class="card-header"><center>Sistema Magaly</center>
                </div>

                <div class="card-body">
                  <div class="panel-body">
                    O Sistema de Gestão Alimentar <strong>Magaly</strong> tem como objetivo facilitar as atividades de gerenciamento da merenda escolar, permitindo de forma simples o controle de estoque, de distribuições, a criação de refeições e cardápios e o acesso rápido aos dados cadastrados no sistema.
                    <br><br>
                    seducdivtecnologia@gmail.com
                  </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
