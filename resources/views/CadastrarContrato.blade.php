@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Contrato') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/contrato/cadastrar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="valor_total" class="col-md-4 col-form-label text-md-right">{{ __('Valor Total ') }}</label>

                            <div class="col-md-6">
                              <input name="valor_total" id="valor_total" type="text" class="form-control" required value= {{ old('valor_total')}}> {{ $errors->first('valor_total')}}


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fornecedor_id" class="col-md-4 col-form-label text-md-right">{{ __('Escola') }}</label>
                            @if(count($fornecedores) != 0 and count($fornecedores) != 0)
                            <div class="col-md-6">
                              <select class="form-control" id="fornecedores" name="fornecedor_id" required="required">
      								              <option value="0">Selecione um Fornecedor</option>
      								              @foreach($fornecedores as $fornecedor)
      									            <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
      								              @endforeach
                              </select>
                            </div>
                            @else
                            <div class="col-md-6">
                              <select class="form-control" id="fornecedores" name="fornecedor_id" >
      								              <option value="0">Não há fornecedores cadastradas</option>
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
