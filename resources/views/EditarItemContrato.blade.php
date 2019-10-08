@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reajustar preço único.') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/itemContrato/salvar') }}">
                      <input type="hidden" name="contrato_id" value="{{ $contrato->id}}" />
                      <input type="hidden" name="contrato_item_id" value="{{ $contrato_item->id}}" />
                      {{ csrf_field() }}
                        @csrf
                        @php
                          $item = \App\Item::find($contrato_item->item_id);
                        @endphp
                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" readonly=“true” value="{{ $item->nome}}" required value= {{ old('nome')}}> {{ $errors->first('nome')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <input name="descricao" id="descricao" type="text" class="form-control" readonly=“true” value="{{ $item->descricao}}" value= {{ old('descricao')}}> {{ $errors->first('descricao')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gramatura" class="col-md-4 col-form-label text-md-right">{{ __('Gramatura ') }}</label>

                            <div class="col-md-6">
                              <input name="gramatura" id="gramatura" type="text" class="form-control" readonly=“true” value="{{ $item->gramatura}}{{ $item->unidade}}" required value= {{ old('gramatura')}}> {{ $errors->first('gramatura')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade ') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade" id="quantidade" type="number" min="0"  class="form-control" value="{{ $contrato_item->quantidade}}" required value= {{ old('quantidade')}}> {{ $errors->first('quantidade')}}
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="valor_unitario" class="col-md-4 col-form-label text-md-right">{{ __('Valor Unitário ') }}</label>

                          <div class="col-md-6">
                            <input name="valor_unitario" id="valor_unitario" placeholder="0.0" required type="text" pattern="[0-9]*\.?[0-9]+$" class="form-control" value="{{ $contrato_item->valor_unitario}}" required value= {{ old('valor_unitario')}}> {{ $errors->first('valor_unitario')}}
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