@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Inserir Itens') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($itens) == 0 and count($itens) == 0)
                      <div class="alert alert-danger">
                              Você ainda não cadastrou nenhum item.
                      </div>
                      @else
                              <div class="form-group row">
                                <div class="col-md-3">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-2">
                                  Gramatura
                                </div>
                                <div class="col-md-2">
                                  <center>N° lote</center>
                                </div>
                                <div class="col-md-2">
                                  <center>Quantidade</center>
                                </div>
                              </div>
                              @foreach ($itens as $item)
                              <form method="POST" action="/refeicao/inserirItem">
                                {{ csrf_field() }}
                                  @csrf
                              <input type="hidden" name="refeicao_id" value="{{ $refeicao->id}}" />
                              <input type="hidden" name="item_id" value="{{ $item->id}}" />

                              <div class="form-group row">

                                  <div class="col-md-3">
                                    {{ $item->nome }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ $item->gramatura }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ $item->n_lote }}
                                  </div>

                                  <div class="col-md-2">
                                    <input name="quantidade" id="quantidade" type="number"  class="form-control" required value= {{ old('quantidade')}}> {{ $errors->first('quantidade')}}
                                  </div>
                                  <div class="col-md-1">
                                    <?php
                                        $refeicao_item = \App\Refeicao_item::where('refeicao_id', '=', $refeicao->id)
                                                                                ->where('item_id', '=', $item->id)
                                                                                ->first();
                                        if(empty($refeicao_item)){ ?>
                                          <button class="btn btn-success" type="submit">+</button>
                                      <?php } else { ?>
                                        <a class="btn btn-danger" href="/refeicao/removerItem/{{$refeicao_item->id}}">
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
                      <center><a class="btn btn-primary" href="/refeicao/finalizarRefeicao/{{$refeicao->id}}">Concluir</a></center>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
