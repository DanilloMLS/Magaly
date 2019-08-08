@extends('layouts.app')

@section('content')

<script type="text/javascript">

</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Visualizar Cardápio') }}</div>

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
                                      <td data-title="Segunda">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 1)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>

                                      </td>
                                      <td data-title="Terça">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 2)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Quarta">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 3)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Quinta">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 4)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Sexta">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 5)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td data-title="Segunda">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 1)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Terça">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 2)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Quarta">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 3)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Quinta">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 4)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Sexta">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 5)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td data-title="Segunda">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 3)->where('dia_semana', '=', 1)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Terça">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 3)->where('dia_semana', '=', 2)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Quarta">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 3)->where('dia_semana', '=', 3)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Quinta">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 3)->where('dia_semana', '=', 4)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
                                      <td data-title="Sexta">
                                        <?php
                                        $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 3)->where('dia_semana', '=', 5)->first();
                                        if(!empty($cardapio_diario)){
                                          $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                          $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                        ?>
                                        {{$refeicao->nome}}
                                      <?php } ?>
                                      </td>
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
                                  <td data-title="Segunda">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 1)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>

                                  </td>
                                  <td data-title="Terça">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 2)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Quarta">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 3)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Quinta">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 4)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Sexta">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 5)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td data-title="Segunda">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 1)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Terça">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 2)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Quarta">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 3)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Quinta">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 4)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Sexta">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 2)->where('dia_semana', '=', 5)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
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
                                  <td data-title="Segunda">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 1)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>

                                  </td>
                                  <td data-title="Terça">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 2)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Quarta">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 3)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Quinta">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 4)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                  <td data-title="Sexta">
                                    <?php
                                    $cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('refeicao', '=', 1)->where('dia_semana', '=', 5)->first();
                                    if(!empty($cardapio_diario)){
                                      $cardapio_diario_refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->first();
                                      $refeicao = \App\Refeicao::find($cardapio_diario_refeicoes->refeicao_id);
                                    ?>
                                    {{$refeicao->nome}}
                                  <?php } ?>
                                  </td>
                                </tr>

                              </tbody>
                            </table>
                          </div>
                          @php
                         }
                        @endphp
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
