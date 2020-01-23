@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Item de Ordem de Fornecimento') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/ordemfornecimento/salvarItem') }}">
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
                              <input name="nome" id="nome" type="text" class="form-control" readonly=“true” value= "{{ old('nome', $item->nome)}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <input name="descricao" id="descricao" type="text" class="form-control" readonly=“true” value= "{{ old('descricao',$item->descricao)}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gramatura" class="col-md-4 col-form-label text-md-right">{{ __('Gramatura ') }}</label>

                            <div class="col-md-6">
                              <input name="gramatura" id="gramatura" type="text" class="form-control" readonly=“true” value="{{ $item->gramatura}}{{ $item->unidade}}" value= {{ old('gramatura')}}>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantidade_pedida" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade_pedida" id="quantidade_pedida" type="text"  class="form-control{{ $errors->has('quantidade_pedida') ? ' is-invalid' : '' }}" value="{{ $ordem_item->quantidade_pedida}}">
                              @if ($errors->has('quantidade_pedida'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantidade_pedida') }}</strong>
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