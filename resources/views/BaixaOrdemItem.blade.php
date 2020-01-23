@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Baixa de Item') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/ordemfornecimento/revisaItem') }}">
                      <input type="hidden" name="id" value="{{ $ordem_item->id}}" />
                      {{ csrf_field() }}
                        @csrf
                        @php
                          $contrato_item = \App\Contrato_item::find($ordem_item->contratoitem_id);
                          $item = \App\Item::find($contrato_item->item_id);
                        @endphp
                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" readonly=“true” value="{{ $item->nome}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <input name="descricao" id="descricao" type="text" class="form-control" readonly=“true” value="{{ $item->descricao}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gramatura" class="col-md-4 col-form-label text-md-right">{{ __('Gramatura ') }}</label>

                            <div class="col-md-6">
                              <input name="gramatura" id="gramatura" type="text" class="form-control" readonly=“true” value="{{ $item->gramatura}}{{ $item->unidade}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantidade_pedida" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade Pedida ') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade_pedida" id="quantidade_pedida" type="text" readonly="true" class="form-control" value= "{{$ordem_item->quantidade_pedida}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantidade_aceita" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade Aceita ') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade_aceita" id="quantidade_aceita" type="text" class="form-control{{ $errors->has('quantidade_aceita') ? ' is-invalid' : '' }}" value= "{{old('quantidade_aceita', $ordem_item->quantidade_aceita)}}">
                              @if ($errors->has('quantidade_aceita'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantidade_aceita') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantidade_restante" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade Restante ') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade_restante" id="quantidade_restante" readonly="true" type="text" class="form-control" value= "{{$ordem_item->quantidade_restante}}">
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="n_lote" class="col-md-4 col-form-label text-md-right">{{ __('Nº Lote ') }}</label>

                          <div class="col-md-6">
                            <input name="n_lote" id="n_lote" type="text" class="form-control{{ $errors->has('n_lote') ? ' is-invalid' : '' }}" value= "{{old('n_lote', $ordem_item->n_lote)}}">
                            @if ($errors->has('n_lote'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('n_lote') }}</strong>
                                  </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="data_validade" class="col-md-4 col-form-label text-md-right">{{ __('Data de Validade ') }}</label>

                          <div class="col-md-6">
                            <input name="data_validade" id="data_validade" type="date" class="form-control{{ $errors->has('data_validade') ? ' is-invalid' : '' }}" value= "{{old('data_validade', $ordem_item->data_validade)}}">
                            @if ($errors->has('data_validade'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('data_validade') }}</strong>
                                  </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Salvar
                              </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
