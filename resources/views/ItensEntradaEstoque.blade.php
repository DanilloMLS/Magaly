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
                              Não há itens cadastrados no banco de dados.
                      </div>
                      @else
                              <div class="form-group row">
                                <div class="col-md-2">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-1">
                                  Gramatura
                                </div>
                                <div class="col-md-2">
                                  <center>N° lote</center>
                                </div>
                                <div class="col-md-2">
                                  <center>Danificados</center>
                                </div>
                                <div class="col-md-2">
                                  <center>Quantidade</center>
                                </div>
                              </div>
                              @foreach ($itens as $item)
                              <form method="POST" action="/estoque/inserirEntrada">
                                {{ csrf_field() }}
                                  @csrf
                              <input type="hidden" name="estoque_id" value="{{ $estoque->id}}" />
                              <input type="hidden" name="item_id" value="{{ $item->id}}" />

                              <div class="form-group row">

                                  <div class="col-md-2">
                                    {{ $item->nome }}
                                  </div>
                                  <div class="col-md-1">
                                    {{ $item->gramatura }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ $item->n_lote }}
                                  </div>

                                  <div class="col-md-2">
                                    <input name="quantidade_danificados" id="quantidade_danificados" type="number"  class="form-control" value= {{ old('quantidade_danificados')}}> {{ $errors->first('quantidade_danificados')}}
                                  </div>
                                  <div class="col-md-2">
                                    <input name="quantidade" id="quantidade" type="number"  class="form-control" required value= {{ old('quantidade')}}> {{ $errors->first('quantidade')}}
                                  </div>
                                  <div class="col-md-1">
                                    <?php
                                        $estoque_item = \App\Estoque_item::where('estoque_id', '=', $estoque->id)
                                                                                ->where('item_id', '=', $item->id)
                                                                                ->first();
                                        /*if(empty($estoque_item)){*/ ?>
                                          <button class="btn btn-success" type="submit">+</button>
                                      <?php /*} else {*/ ?>
                                        <!-- <a class="btn btn-danger" href="/estoque/inserirSaida/{{$estoque_item->id}}"> -->
                                        -
                                        </a>
                                    <?php /*}*/ ?>

                                  </div>
                              </div>

                            </form>


                              @endforeach

                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <center><a class="btn btn-primary" href="/estoque/finalizarEstoque/{{$estoque->id}}">Concluir</a></center>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection