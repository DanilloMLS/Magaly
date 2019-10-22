@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Item no Contrato') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/contrato/inserirItem') }}">
                      {{ csrf_field() }}
                        @csrf

                        <input type="hidden" name="contrato_id" value="{{$contrato->id}}" />

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value= {{ old('nome')}}>
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
                            <input name="marca" id="marca" type="text" class="form-control{{ $errors->has('marca') ? ' is-invalid' : '' }}" value= {{ old('marca')}}>
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
                              <textarea name="descricao" id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" value= {{ old('descricao')}}></textarea>
                              @if ($errors->has('descricao'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="valor_unitario" class="col-md-4 col-form-label text-md-right">{{ __('Valor Unitário ') }}</label>

                          <div class="col-md-6">
                            <input name="valor_unitario" id="valor_unitario" type="text" class="form-control{{ $errors->has('valor_unitario') ? ' is-invalid' : '' }}" value= {{ old('valor_unitario')}}>
                            @if ($errors->has('valor_unitario'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('valor_unitario') }}</strong>
                                    </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="gramatura" class="col-md-4 col-form-label text-md-right">{{ __('Gramatura ') }}</label>

                          <div class="col-md-3">
                            <input name="gramatura" id="n_lote" type="text" class="form-control{{ $errors->has('gramatura') ? ' is-invalid' : '' }}" value= {{ old('gramatura')}}>
                            @if ($errors->has('gramatura'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('gramatura') }}</strong>
                                  </span>
                            @endif
                          </div>
                          <div class="col-md-2">
                            <select class="form-control{{ $errors->has('unidade') ? ' is-invalid' : '' }}" id="unidade" name="unidade">
                                  <option value="">Unidade</option>
                                  <option value="G">g</option>
                                  <option value="ML">ml</option>
                            </select>
                            @if ($errors->has('unidade'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('unidade') }}</strong>
                                  </span>
                            @endif
                          </div>
                      </div>

                        <div class="form-group row">
                          <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade ') }}</label>

                          <div class="col-md-6">
                            <input name="quantidade" id="quantidade" type="text" class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}" value= {{ old('quantidade')}}>
                            @if ($errors->has('quantidade'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('quantidade') }}</strong>
                                  </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Inserir
                              </button>
                              <a class="btn btn-primary" href={{route ('/contrato/exibirItensContrato', ['id' => $contrato->id])}}>Finalizar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
