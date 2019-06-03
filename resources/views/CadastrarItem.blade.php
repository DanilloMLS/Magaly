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
                            <label for="valor_unitario" class="col-md-4 col-form-label text-md-right">{{ __('Valor Unitário ') }}</label>

                            <div class="col-md-6">
                              <input name="valor_unitario" id="valor_unitario" type="text" class="form-control" required value= {{ old('valor_unitario')}}> {{ $errors->first('valor_unitario')}}


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="data_validade" class="col-md-4 col-form-label text-md-right">{{ __('Data de validade ') }}</label>

                            <div class="col-md-6">
                              <input name="data_validade" id="data_validade" type="text" class="form-control" required value= {{ old('data_validade')}}> {{ $errors->first('data_validade')}}


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="n_lote" class="col-md-4 col-form-label text-md-right">{{ __('Nº de lote ') }}</label>

                            <div class="col-md-6">
                              <input name="n_lote" id="n_lote" type="text" class="form-control" required value= {{ old('n_lote')}}> {{ $errors->first('n_lote')}}


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <input name="descricao" id="descricao" type="text" class="form-control" required value= {{ old('descricao')}}> {{ $errors->first('descricao')}}


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unidade" class="col-md-4 col-form-label text-md-right">{{ __('Unidade ') }}</label>

                            <div class="col-md-6">
                              <input name="unidade" id="n_lote" type="text" class="form-control" required value= {{ old('unidade')}}> {{ $errors->first('unidade')}}


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contrato_id" class="col-md-4 col-form-label text-md-right">{{ __('Contrato') }}</label>
                            @if(count($contratos) != 0 and count($contratos) != 0)
                            <div class="col-md-6">
                              <select class="form-control" id="contratos" name="contrato_id" required>
      								              <option value="">Selecione um Contrato</option>
      								              @foreach($contratos as $contrato)
      									            <option value="{{$contrato->id}}">{{$contrato->id}}</option>
      								              @endforeach
                              </select>
                            </div>
                            @else
                            <div class="col-md-6">
                              <select class="form-control" id="contratos" name="contrato_id" required>
      								              <option value="">Não há contratos cadastrados</option>
                              </select>
                            </div>
                            @endif
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