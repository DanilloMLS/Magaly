@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Inserir Refeição') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($refeicoes) == 0 and count($refeicoes) == 0)
                      <div class="alert alert-danger">
                              Você ainda não cadastrou nenhuma refeição.
                      </div>
                      @else
                              <div class="form-group row">
                                <div class="col-md-3">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-2">
                                  Descrição
                                </div>
                                <div class="col-md-2">
                                  <center>Peso</center>
                                </div>
                              </div>
                              @foreach ($refeicoes as $refeicao)
                              <form method="POST" action="/cardapio/inserirItem">
                                {{ csrf_field() }}
                                  @csrf
                              <input type="hidden" name="cardapio_diario" value="{{ $cardapio_diario->id}}" />
                              <input type="hidden" name="cardapio_mensal" value="{{ $cardapio_mensal->id}}" />
                              <input type="hidden" name="cardapio_semanal" value="{{ $cardapio_semanal->id}}" />
                              <input type="hidden" name="cardapio_semanal" value="{{ $cardapio_semanal->id}}" />
                              <input type="hidden" name="refeicao_id" value="{{ $refeicao->id}}" />

                              <div class="form-group row">

                                  <div class="col-md-3">
                                    {{ $refeicao->nome }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ $refeicao->descricao }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ $refeicao->peso_liquido }}
                                  </div>
                                  <div class="col-md-2">

                                    <?php
                                        $cardapio_refeicao = \App\cardapio_diario_refeicao::where('refeicao_id', '=', $refeicao->id)
                                                                                ->where('cardapio_diario_id', '=', $cardapio_diario->id)
                                                                                ->first();
                                        if(empty($cardapio_refeicao)){ ?>
                                          <button class="btn btn-success" type="submit">+</button>
                                      <?php } else { ?>
                                        <a class="btn btn-danger" href="/cardapio/removerItem/{{$cardapio_refeicao->id}}">
                                        -
                                        </a>
                                    <?php } ?>

                                  </div>
                              </div>

                            </form>


                              @endforeach

                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <center><a class="btn btn-primary" href="/cardapioDiario/finalizarCardapio/{{$cardapio_mensal->id}}">Concluir</a></center>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
