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
                              <input name="nome" id="nome" type="text" class="form-control" required value="{{ $item->nome}}" > {{ $errors->first('nome')}}
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca ') }}</label>

                          <div class="col-md-6">
                            <input name="marca" id="marca" type="text" class="form-control" required value="{{ $item->marca}}" > {{ $errors->first('marca')}}
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <input name="descricao" id="descricao" type="text" class="form-control" required value="{{ $item->descricao}}" > {{ $errors->first('descricao')}}
                            </div>
                        </div>

			<div class="form-group row">
                            <label for="gramatura" class="col-md-4 col-form-label text-md-right">{{ __('Gramatura ') }}</label>

                            <div class="col-md-3">
                              <input name="gramatura" id="gramatura" type="number" class="form-control" required value="{{ $item->gramatura}}"> {{ $errors->first('gramatura')}}
                            </div>
                            <div class="col-md-2">
                              <select class="form-control" id="unidade" name="unidade" required value="{{ $item->unidade}}">
                                    <option value="">Unidade</option>

					<option value="G" @if(strcasecmp($item->unidade, 'G') == 0) selected="selected" @endif> G </option>
					<option value="ML" @if(strcasecmp($item->unidade, 'ML') == 0) selected="selected" @endif> ML </option>
				</select>
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
