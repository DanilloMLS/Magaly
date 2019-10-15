@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Fornecedor') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/fornecedor/salvar') }}">
                      <input type="hidden" name="id" value="{{ $fornecedor->id}}" />
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome da fornecedor') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" value="{{ $fornecedor->nome}}" value= {{ old('nome')}} > {{ $errors->first('nome')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cnpj" class="col-md-4 col-form-label text-md-right">{{ __('CNPJ') }}</label>

                            <div class="col-md-6">
                              <input name="cnpj" id="cnpj" type="text" class="form-control" value="{{ $fornecedor->cnpj}}" > {{ $errors->first('cnpj')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                            <div class="col-md-6">
                              <input name="telefone" id="telefone" type="text" class="form-control" value="{{ $fornecedor->telefone}}" > {{ $errors->first('telefone')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $fornecedor->email}}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Salvar
                              </button>
                              <a class="btn-cancelar btn btn-primary" href="{{route ('/fornecedor/listar')}}">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
