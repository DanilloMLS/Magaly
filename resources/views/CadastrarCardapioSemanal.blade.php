@extends('layouts.app')

@section('content')

<script type="text/javascript">

</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __($cardapio->modalidade_ensino."   (".date('d/m/Y', strtotime($cardapio->data_inicio))." - ".date('d/m/Y', strtotime($cardapio->data_fim)).")") }}</div>

                <div class="card-body">
                      {{ csrf_field() }}
                        @csrf
                        <div id="Cardapio">
                          @php

                          $dia_semana = ["Segunda","Terça","Quarta","Quinta","Sexta"];
                          $quant_ref = 1;
                          $dia_x = 1;
                          $refeicao_x = 1;
                          if(strcmp($cardapio->modalidade_ensino, 'Creche Infantil Integral') == 0) $quant_ref = 3;
                          else if(strcmp($cardapio->modalidade_ensino, 'Creche Infantil Parcial') == 0) $quant_ref = 2;
                          else if(strcmp($cardapio->modalidade_ensino, 'Infantil (Pré-escola)') == 0 || strcmp($cardapio->modalidade_ensino, 'Ensino Fundamental') == 0 || strcmp($cardapio->modalidade_ensino, 'EJA') == 0 || strcmp($cardapio->modalidade_ensino, 'Quilombola') == 0) $quant_ref = 1;

                          $semana_x = 1;
                          for($semana_x=1; $semana_x<= 5; $semana_x++){
                          @endphp
                            @php
                            $cardapio_semanal = \App\Cardapio_semanal::where('cardapio_mensal_id', '=', $cardapio->id)->where('semana', '=', $semana_x)->first();
                            @endphp
                            <center><strong><h4 style="background-color:powderblue;">Semana {{$semana_x}}</h4><strong></center>
                            <div id="tabela_integral" class="table-responsive">
                              <table class="no-background table table-hover">
                                <thead>
                                  <tr align="center">
                                      <th>Segunda</th>
                                      <th>Terça</th>
                                      <th>Quarta</th>
                                      <th>Quinta</th>
                                      <th>Sexta</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php for($refeicao_x = 1; $refeicao_x <= $quant_ref; $refeicao_x++){ @endphp
                                    <tr align=center>
                                      @php for($dia_x = 1; $dia_x <= 5; $dia_x++){ @endphp
                                        @php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', $dia_x)->where('refeicao', '=' , $refeicao_x)->first(); @endphp
                                        @if(!empty($cardapio_diario))
                                          @php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          @endphp
                                          <td class="cardapio_semana_20-justify" data-title="Segunda" style="color:green">               
                                            <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => $dia_x, 'cardapio_semanal' => $semana_x, 'cardapio_mensal' => $cardapio->id, 'refeicao' => $refeicao_x]) }}">
                                              {{$refeicao->nome}}
                                            </a>

                                          </td>
                                          @else
                                          <td class="cardapio_semana_20" data-title="Segunda">
                                            <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => $dia_x, 'cardapio_semanal' => $semana_x, 'cardapio_mensal' => $cardapio->id, 'refeicao' => $refeicao_x]) }}">Adicionar</a>
                                          </td>
                                        @endif
                                      @php
                                      }
                                      @endphp
                                    </tr>  
                                  @php
                                  }
                                  @endphp
                                </tbody>
                              </table>
                            </div>
                          @php
                          }
                          @endphp
                        </div>
                        <div class="panel-footer">
                            <center><a class="link" class="btn btn-primary" href="{{route ('/cardapioMensal/finalizarCardapio')}}">Concluir</a></center>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
