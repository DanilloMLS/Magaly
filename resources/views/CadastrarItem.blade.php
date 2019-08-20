@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Item') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/item/cadastrar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" required value= {{ old('nome')}}> {{ $errors->first('nome')}}

                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca ') }}</label>

                          <div class="col-md-6">
                            <input name="marca" id="marca" type="text" class="form-control" required value= {{ old('marca')}}> {{ $errors->first('marca')}}

                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <textarea name="descricao" id="descricao" type="text" class="form-control" value= {{ old('descricao')}}> {{ $errors->first('descricao')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gramatura" class="col-md-4 col-form-label text-md-right">{{ __('Gramatura ') }}</label>

                            <div class="col-md-3">
                              <input name="gramatura" id="n_lote" type="text" placeholder="ex: 100" pattern="^[-+]?[0-9]*" class="form-control" required value= {{ old('gramatura')}}> {{ $errors->first('gramatura')}}
                            </div>
                            <div class="col-md-2">
                              <select class="form-control" id="unidade" name="unidade" required>
                                    <option value="">Unidade</option>
                                    <option value="G">g</option>
                                    <option value="ML">ml</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Cadastrar
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
