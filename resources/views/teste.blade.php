<!-- @php
$cardapio_diario = \App\Cardapio_diario::where('cardapio_semanals_id', '=', $cardapio_semanal->id)->where('dia_semana', '=', 1)->first();
@endphp
@if(!empty($cardapio_diario))
  @php
  $refeicoes = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio_diario->id)->get();
  @endphp
  @foreach($refeicoes as $ref)
    @php
    $nomes = "";
    $refeicao = \App\Refeicao::find($ref->id);
    $nomes = $nomes . $refeicao->nome;
    @endphp

  @endforeach
  {{ $nomes }}
@else
@endif -->
