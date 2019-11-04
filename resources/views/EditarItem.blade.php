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
                              <input name="nome" id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{old('nome', $item->nome)}}" >
                              @if ($errors->has('nome'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca ') }}</label>

                          <div class="col-md-6">
                            <input name="marca" id="marca" type="text" class="form-control{{ $errors->has('marca') ? ' is-invalid' : '' }}" value="{{old('marca', $item->marca)}}" >
                            @if ($errors->has('marca'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('marca') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <textarea name="descricao" id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}">{{old('descricao', $item->descricao)}}</textarea>
                              @if ($errors->has('descricao'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('descricao') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>

			                  <div class="form-group row">
                            <label for="gramatura" class="col-md-4 col-form-label text-md-right">{{ __('Gramatura ') }}</label>

                            <div class="col-md-3">
                              <input name="gramatura" id="gramatura" type="text" class="form-control{{ $errors->has('gramatura') ? ' is-invalid' : '' }}" value="{{old('grmatura', $item->gramatura)}}">
                              @if ($errors->has('gramatura'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('gramatura') }}</strong>
                                  </span>
                              @endif
                            </div>
                            <div class="col-md-2">
                              <select class="form-control{{ $errors->has('unidade') ? ' is-invalid' : '' }}" id="unidade" name="unidade" value="{{ $item->unidade}}">
                                    <option value="">Unidade</option>

                                    <option value="g" @if(strcasecmp($item->unidade, 'g') == 0) selected="selected" @endif> g </option>
                                    <option value="ml" @if(strcasecmp($item->unidade, 'ml') == 0) selected="selected" @endif> ml</option>
                              </select>
                              @if ($errors->has('unidade'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('unidade') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Salvar
                              </button>
                                <a class="btn-cancelar btn btn-primary" href="{{route ('/item/listar')}}">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
