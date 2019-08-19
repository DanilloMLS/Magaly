@extends('layouts.app')

@section('content')

<script type="text/javascript">

</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inserir Cardápio semanal') }}</div>

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
                            <center><strong><h4>Semana {{$i}}</h4><strong></center>
                            <div id="tabela_integral" class="table-responsive">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                      <th>Segunda</th>
                                      <th>Terça</th>
                                      <th>Quarta</th>
                                      <th>Quinta</th>
                                      <th>Sexta</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td data-title="Segunda" style="color:green">
                                          Refeição 1
                                        </td>
                                        @else
                                        <td data-title="Segunda">
                                          <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                        </td>
                                        @endif

                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td data-title="Terça" style="color:green">
                                          Refeição 1
                                        </td>
                                        @else
                                        <td data-title="Terça">
                                          <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                        </td>
                                        @endif

                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td data-title="Quarta" style="color:green">
                                          Refeição 1
                                        </td>
                                        @else
                                        <td data-title="Quarta">
                                          <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                        </td>
                                        @endif

                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td data-title="Quinta" style="color:green">
                                          Refeição 1
                                        </td>
                                        @else
                                        <td data-title="Quinta">
                                          <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                        </td>
                                        @endif

                                        <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 1)->first();?>
                                        @if(!empty($cardapio_diario))
                                        <td data-title="Sexta" style="color:green">
                                          Refeição 1
                                        </td>
                                        @else
                                        <td data-title="Sexta">
                                          <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                        </td>
                                        @endif

                                    </tr>
                                    <tr>
                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Segunda" style="color:green">
                                        Refeição 2
                                      </td>
                                      @else
                                      <td data-title="Segunda">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Terça" style="color:green">
                                        Refeição 2
                                      </td>
                                      @else
                                      <td data-title="Terça">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Quarta" style="color:green">
                                        Refeição 2
                                      </td>
                                      @else
                                      <td data-title="Quarta">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Quinta" style="color:green">
                                        Refeição 2
                                      </td>
                                      @else
                                      <td data-title="Quinta">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 2)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Sexta" style="color:green">
                                        Refeição 2
                                      </td>
                                      @else
                                      <td data-title="Sexta">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
                                      </td>
                                      @endif
                                    </tr>
                                    <tr>
                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Segunda" style="color:green">
                                        Refeição 3
                                      </td>
                                      @else
                                      <td data-title="Segunda">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Refeição 3</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Terça" style="color:green">
                                        Refeição 3
                                      </td>
                                      @else
                                      <td data-title="Terça">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Refeição 3</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Quarta" style="color:green">
                                        Refeição 3
                                      </td>
                                      @else
                                      <td data-title="Quarta">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Refeição 3</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Quinta" style="color:green">
                                        Refeição 3
                                      </td>
                                      @else
                                      <td data-title="Quinta">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Refeição 3</a>
                                      </td>
                                      @endif

                                      <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 3)->first();?>
                                      @if(!empty($cardapio_diario))
                                      <td data-title="Sexta" style="color:green">
                                        Refeição 3
                                      </td>
                                      @else
                                      <td data-title="Sexta">
                                        <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 3]) }}">Refeição 3</a>
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
                            <center><strong><h4>Semana {{$i}}</h4><strong></center>
                          <div id="tabela_parcial" class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th>Segunda</th>
                                    <th>Terça</th>
                                    <th>Quarta</th>
                                    <th>Quinta</th>
                                    <th>Sexta</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Segunda" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Segunda">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Terça" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Terça">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Quarta" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Quarta">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Quinta" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Quinta">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Sexta" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Sexta">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                    </td>
                                    @endif

                                </tr>
                                <tr>
                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td data-title="Segunda" style="color:green">
                                    Refeição 2
                                  </td>
                                  @else
                                  <td data-title="Segunda">
                                    <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
                                  </td>
                                  @endif

                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td data-title="Terça" style="color:green">
                                    Refeição 2
                                  </td>
                                  @else
                                  <td data-title="Terça">
                                    <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
                                  </td>
                                  @endif

                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td data-title="Quarta" style="color:green">
                                    Refeição 2
                                  </td>
                                  @else
                                  <td data-title="Quarta">
                                    <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
                                  </td>
                                  @endif

                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td data-title="Quinta" style="color:green">
                                    Refeição 2
                                  </td>
                                  @else
                                  <td data-title="Quinta">
                                    <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
                                  </td>
                                  @endif

                                  <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 2)->first();?>
                                  @if(!empty($cardapio_diario))
                                  <td data-title="Sexta" style="color:green">
                                    Refeição 2
                                  </td>
                                  @else
                                  <td data-title="Sexta">
                                    <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 2]) }}">Refeição 2</a>
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
                            <center><strong><h4>Semana {{$i}}</h4><strong></center>
                          <div id="tabela_infantil" class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th>Segunda</th>
                                    <th>Terça</th>
                                    <th>Quarta</th>
                                    <th>Quinta</th>
                                    <th>Sexta</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Segunda" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Segunda">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 1, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 2)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Terça" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Terça">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 2, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 3)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Quarta" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Quarta">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 3, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 4)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Quinta" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Quinta">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 4, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
                                    </td>
                                    @endif

                                    <?php $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 5)->where('refeicao', '=' , 1)->first();?>
                                    @if(!empty($cardapio_diario))
                                    <td data-title="Sexta" style="color:green">
                                      Refeição 1
                                    </td>
                                    @else
                                    <td data-title="Sexta">
                                      <a href="{{ route("/cardapio/inserirRefeicao", ['dia' => 5, 'cardapio_semanal' => $i, 'cardapio_mensal' => $cardapio->id, 'refeicao' => 1]) }}">Refeição 1</a>
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
                                  <center><a class="btn btn-primary" href="{{route ('/cardapioMensal/finalizarCardapio')}}">Concluir</a></center>
                              </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
