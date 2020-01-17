@extends('layouts.app')

@section('content')

<script type="text/javascript">

</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cardápio Mensal - '.$cardapio->nome) }}</div>

                <div class="card-body">
                      {{ csrf_field() }}
                        @csrf
                        @if(strcmp($cardapio->modalidade_ensino, 'Creche Infantil Integral') == 0)
                        <div id="creche_integral">
                          @php
                          $i = 1;
                          for($i=1; $i<= 5; $i++){
                            @endphp
                            @php
                            $cardapio_semanal = \App\Cardapio_semanal::where('cardapio_mensal_id', '=', $cardapio->id)->where('semana', '=', $i)->first();
                            @endphp
                            <center><strong><h4 style="background-color:powderblue;">Semana {{$i}}</h4><strong></center>
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
                                    <tr align=center>
                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td class="cardapio_semana_20-justify" data-title="Segunda" style="color:green">               
                                          <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                            <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                              $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                              echo $refeicao->nome;
                                            ?>
                                          </a>

                                        </td>
                                        @else
                                        <td class="cardapio_semana_20" data-title="Segunda">
                                          <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                        </td>
                                        @endif
                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td class="cardapio_semana_20-justify" data-title="Terça" style="color:green">
                                          <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                            <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                              $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                              echo $refeicao->nome;
                                            ?>
                                          </a>
                                        </td>
                                        @else
                                        <td class="cardapio_semana_20" data-title="Terça">
                                          <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                        </td>
                                        @endif

                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td class="cardapio_semana_20-justify" data-title="Quarta" style="color:green">
                                          <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                            <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                              $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                              echo $refeicao->nome;
                                            ?>
                                          </a>
                                        </td>
                                        @else
                                        <td class="cardapio_semana_20" data-title="Quarta">
                                          <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                        </td>
                                        @endif

                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td class="cardapio_semana_20-justify" data-title="Quinta" style="color:green">
                                          <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                            <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                              $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                              echo $refeicao->nome;
                                            ?>
                                          </a>
                                        </td>
                                        @else
                                        <td class="cardapio_semana_20" data-title="Quinta">
                                          <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                        </td>
                                        @endif

                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td class="cardapio_semana_20-justify" data-title="Sexta" style="color:green">
                                          <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                            <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                              $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                              echo $refeicao->nome;
                                            ?>
                                          </a>
                                        </td>
                                        @else
                                        <td class="cardapio_semana_20" data-title="Sexta">
                                          <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                        </td>
                                        @endif

                                    </tr>
                                    <tr align=center>
                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Segunda" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Segunda">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Terça" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Terça">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Quarta" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Quarta">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Quinta" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Quinta">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Sexta" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Sexta">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                      </td>
                                      @endif
                                    </tr>
                                    <tr align=center>
                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Segunda" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Segunda">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Adicionar</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Terça" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Terça">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Adicionar</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Quarta" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Quarta">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Adicionar</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Quinta" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Quinta">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Adicionar</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td class="cardapio_semana_20-justify" data-title="Sexta" style="color:green">
                                        <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">
                                          <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                            $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                            echo $refeicao->nome;
                                          ?>
                                        </a>
                                      </td>
                                      @else
                                      <td class="cardapio_semana_20" data-title="Sexta">
                                        <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Adicionar</a>
                                      </td>
                                      @endif
                                    </tr>

                                </tbody>
                              </table>
                            </div>
                          @php
                          }
                          @endphp

                        </div>
                        @endif
                        @if(strcmp($cardapio->modalidade_ensino, 'Creche Infantil Parcial') == 0)
                        <div id="creche_parcial">
                          @php
                          $i = 1;
                          for($i=1; $i<= 5; $i++){
                            @endphp
                            @php
                            $cardapio_semanal = \App\Cardapio_semanal::where('cardapio_mensal_id', '=', $cardapio->id)->where('semana', '=', $i)->first();
                            @endphp
                            <center><strong><h4 style="background-color:powderblue;">Semana {{$i}}</h4><strong></center>
                          <div id="tabela_parcial" class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <tr align=center>
                                    <th>Segunda</th>
                                    <th>Terça</th>
                                    <th>Quarta</th>
                                    <th>Quinta</th>
                                    <th>Sexta</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr align=center>
                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Segunda" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Segunda">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Terça" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Terça">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Quarta" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Quarta">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Quinta" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Quinta">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Sexta" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Sexta">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                </tr>
                                <tr>
                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td class="cardapio_semana_20-justify" data-title="Segunda" style="color:green">
                                    <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                      <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                        $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                        echo $refeicao->nome;
                                      ?>
                                    </a>
                                  </td>
                                  @else
                                  <td class="cardapio_semana_20" data-title="Segunda">
                                    <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                  </td>
                                  @endif

                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td class="cardapio_semana_20-justify" data-title="Terça" style="color:green">
                                    <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                      <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                        $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                        echo $refeicao->nome;
                                      ?>
                                    </a>
                                  </td>
                                  @else
                                  <td class="cardapio_semana_20" data-title="Terça">
                                    <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                  </td>
                                  @endif

                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td class="cardapio_semana_20-justify" data-title="Quarta" style="color:green">
                                    <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                      <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                        $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                        echo $refeicao->nome;
                                      ?>
                                    </a>
                                  </td>
                                  @else
                                  <td class="cardapio_semana_20" data-title="Quarta">
                                    <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                  </td>
                                  @endif

                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td class="cardapio_semana_20-justify" data-title="Quinta" style="color:green">
                                    <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                      <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                        $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                        echo $refeicao->nome;
                                      ?>
                                    </a>
                                  </td>
                                  @else
                                  <td class="cardapio_semana_20" data-title="Quinta">
                                    <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                  </td>
                                  @endif

                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td class="cardapio_semana_20-justify" data-title="Sexta" style="color:green">
                                    <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">
                                      <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                        $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                        echo $refeicao->nome;
                                      ?>
                                    </a>
                                  </td>
                                  @else
                                  <td class="cardapio_semana_20" data-title="Sexta">
                                    <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Adicionar</a>
                                  </td>
                                  @endif
                                </tr>

                              </tbody>
                            </table>
                          </div>
                          @php
                           }
                        @endphp
                        </div>
                        @endif
                        @if (strcmp($cardapio->modalidade_ensino, 'Infantil (Pré-escola)') == 0 || strcmp($cardapio->modalidade_ensino, 'Ensino Fundamental') == 0 || strcmp($cardapio->modalidade_ensino, 'EJA') == 0 || strcmp($cardapio->modalidade_ensino, 'Quilombola') == 0)
                        <div id="infantil">
                          @php
                          $i = 1;
                          for($i=1; $i<= 5; $i++){
                            @endphp
                            @php
                            $cardapio_semanal = \App\Cardapio_semanal::where('cardapio_mensal_id', '=', $cardapio->id)->where('semana', '=', $i)->first();
                            @endphp
                            <center><strong><h4 style="background-color:powderblue;">Semana {{$i}}</h4></strong></center>
                          <div id="tabela_infantil" class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <tr align=center>
                                    <th><strong>Segunda</strong></th>
                                    <th><strong>Terça</strong></th>
                                    <th><strong>Quarta</strong></th>
                                    <th><strong>Quinta</strong></th>
                                    <th><strong>Sexta</strong></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr align=center>
                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Segunda" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Segunda">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Terça" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Terça">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Quarta" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Quarta">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Quinta" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Quinta">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td class="cardapio_semana_20-justify" data-title="Sexta" style="color:green">
                                      <a class="green-link link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">
                                        <?php $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::where('id', $cardapio_diario_refeicoes->refeicao_id)->first();
                                          echo $refeicao->nome;
                                        ?>
                                      </a>
                                    </td>
                                    @else
                                    <td class="cardapio_semana_20" data-title="Sexta">
                                      <a class="link" href="{{ route("/cardapio/editarRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Adicionar</a>
                                    </td>
                                    @endif

                                </tr>

                              </tbody>
                            </table>
                          </div>
                          @php
                         }
                        @endphp
                        </div>
                        @endif

                              <div class="panel-footer">
                                  <center><a class="link" class="btn btn-primary" href="{{route ('/cardapioMensal/finalizarCardapio')}}">Concluir</a></center>
                              </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
