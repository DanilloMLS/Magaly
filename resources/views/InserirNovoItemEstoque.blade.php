@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Inserir Item no Estoque') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/estoque/novoItem') }}">
                      {{ csrf_field() }}
                        @csrf

                        <input type="hidden" name="estoque_id" value="{{$estoque->id}}" />

                        <div class="form-group row">
                            <label for="item_id" class="col-md-4 col-form-label text-md-right">{{ __('Item') }}</label>
                            @if(count($itens_contrato))
                            <div class="col-md-6">
                              <select class="form-control" id="itens" name="item_contrato_id">
      								              <option value="">Selecione um Item</option>
                                    @foreach($itens_contrato as $item_contrato)
                                      @php
                                          $item = \App\Item::find($item_contrato->item_id);
                                          $contrato = \App\Contrato::find($item_contrato->contrato_id);
                                          $fornecedor = \App\Fornecedor::find($contrato->fornecedor_id);
                                      @endphp
      									              <option value="{{$item_contrato->id}}">{{$item->nome}} - {{$item->gramatura}}{{$item->unidade}} - {{$fornecedor->nome}} - Contrato Nº {{$contrato->n_contrato}}</option>
      								              @endforeach
                              </select>
                            </div>
                            @else
                            <div class="col-md-6">
                              <select class="form-control" id="itens" name="item_id">
      								              <option value="">Não há itens cadastrados</option>
                              </select>
                            </div>
                            @endif
                         </div>

                        <div class="form-group row">
                            <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade" id="quantidade" type="number" class="form-control" value= {{ old('quantidade')}}> {{ $errors->first('quantidade')}}</input>

                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="quantidade_danificados" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade danificados') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade_danificados" id="quantidade_danificados" type="number" class="form-control" value= {{ old('quantidade_danificados')}}> {{ $errors->first('quantidade_danificados')}}</input>

                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="data_validade" class="col-md-4 col-form-label text-md-right">{{ __('Data de Validade ') }}</label>

                          <div class="col-md-6">
                            <input name="data_validade" id="data_validade" type="date" class="form-control" value= {{ old('data_validade')}}> {{ $errors->first('data_validade')}}
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="n_lote" class="col-md-4 col-form-label text-md-right">{{ __('Lote ') }}</label>

                          <div class="col-md-6">
                            <input name="n_lote" id="n_lote" type="text" class="form-control" value= {{ old('n_lote')}}> {{ $errors->first('n_lote')}}
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Inserir no Estoque
                              </button>
                            <a class="btn btn-primary" href="{{ route ("/estoque/exibirItensEstoque", ['id' => $estoque->id])}}">Finalizar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection