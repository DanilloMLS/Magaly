@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Ordem de Fornecimento') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/ordemfornecimento/store') }}">
                      {{ csrf_field() }}
                        @csrf

                        <input type="hidden" name="fornecedor_id" value="{{ $fornecedor->id}}" />

                        <div class="form-group row">
                            <label for="observacao" class="col-md-4 col-form-label text-md-right">{{ __('Observação ') }}</label>

                            <div class="col-md-6">
                              <textarea name="observacao" id="observacao" type="text" class="form-control{{ $errors->has('observacao') ? ' is-invalid' : '' }}">{{ old('observacao')}}</textarea>
                              @if ($errors->has('observacao'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('observacao') }}</strong>
                                    </span>
                              @endif

                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="id_estoque" class="col-md-4 col-form-label text-md-right">{{ __('Estoque') }}</label>
                        @if(count($estoques) != 0)
                        <div class="col-md-6">
                            <select class="form-control{{ $errors->has('estoque_id') ? ' is-invalid' : '' }}" id="estoques" name="estoque_id">
                                <option value="">Selecione um Estoque</option>
                                @foreach($estoques as $estoque)
                                <option value="{{$estoque->id}}" {{ old('estoque_id') == $estoque->id ? 'selected' : '' }}>{{$estoque->nome}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('estoque_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('estoque_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        @else
                        <div class="col-md-6">
                            <select class="form-control{{ $errors->has('estoque_id') ? ' is-invalid' : '' }}" id="estoques" name="estoque_id">
                                <option value="">Não há estoques cadastrados</option>
                            </select>
                            @if ($errors->has('estoque_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('estoque_id') }}</strong>
                                </span>
                            @endif
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