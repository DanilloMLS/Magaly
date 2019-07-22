@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Item') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/item/salvar') }}">
                      <input type="hidden" name="id" value="{{ $item->id}}" />
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" value="{{ $item->nome}}" > {{ $errors->first('nome')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="data_validade" class="col-md-4 col-form-label text-md-right">{{ __('Data de validade ') }}</label>

                            <div class="col-md-6">
                              <input name="data_validade" id="data_validade" type="date" class="form-control" value="<?= $item->data_validade  ?>" > {{ $errors->first('data_validade')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="n_lote" class="col-md-4 col-form-label text-md-right">{{ __('Nº lote ') }}</label>

                            <div class="col-md-6">
                              <input name="n_lote" id="n_lote" type="text" class="form-control" value="{{ $item->n_lote}}" > {{ $errors->first('n_lote')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <input name="descricao" id="descricao" type="text" class="form-control" value="{{ $item->descricao}}" > {{ $errors->first('descricao')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unidade" class="col-md-4 col-form-label text-md-right">{{ __('Unidade ') }}</label>

                            <div class="col-md-6">
                              <input name="unidade" id="unidade" type="text" class="form-control" value="{{ $item->unidade}}" > {{ $errors->first('unidade')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gramatura" class="col-md-4 col-form-label text-md-right">{{ __('Unidade ') }}</label>

                            <div class="col-md-6">
                              <input name="gramatura" id="gramatura" type="text" class="form-control" value="{{ $item->gramatura}}" > {{ $errors->first('gramatura')}}
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
