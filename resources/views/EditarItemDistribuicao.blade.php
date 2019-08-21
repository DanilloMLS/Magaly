@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Item de Distribuição') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/itemDistribuicao/salvar') }}">
                      <input type="hidden" name="id" value="{{ $item_distribuicao->id}}" />
                      {{ csrf_field() }}
                        @csrf
                        @php
                          $item = \App\Item::find($item_distribuicao->item_id);
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
                            <label for="quantidade_total" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade Total ') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade_total" id="quantidade_total" type="number" min="0"  class="form-control" value="{{ $item_distribuicao->quantidade_total}}" required value= {{ old('quantidade_total')}}> {{ $errors->first('quantidade_total')}}
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
