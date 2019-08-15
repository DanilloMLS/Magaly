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
                            <label for="data" class="col-md-4 col-form-label text-md-right">{{ __('Data ') }}</label>

                            <div class="col-md-6">
                              <input name="data" id="data" type="date" class="form-control" required value= {{ old('data')}}> {{ $errors->first('data')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="n_contrato" class="col-md-4 col-form-label text-md-right">{{ __('Nº Contrato ') }}</label>

                            <div class="col-md-6">
                              <input name="n_contrato" id="n_contrato" type="text" class="form-control" required value= {{ old('n_contrato')}}> {{ $errors->first('n_contrato')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="n_processo_licitatorio" class="col-md-4 col-form-label text-md-right">{{ __('Nº Processo Licitatório ') }}</label>

                            <div class="col-md-6">
                              <input name="n_processo_licitatorio" id="n_processo_licitatorio" type="text" class="form-control" required value= {{ old('n_processo_licitatorio')}}> {{ $errors->first('n_processo_licitatorio')}}
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="modalidade" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade ') }}</label>

                          <div class="col-md-6">
                            <input name="modalidade" id="modalidade" type="text" class="form-control" required value= {{ old('n_processo_licitatorio')}}> {{ $errors->first('modalidade')}}
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <textarea name="descricao" id="descricao" type="date" class="form-control" value= {{ old('descricao')}}> {{ $errors->first('descricao')}} </textarea>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="valor_total" class="col-md-4 col-form-label text-md-right">{{ __('Valor Total ') }}</label>

                            <div class="col-md-6">
                              <input name="valor_total" id="valor_total" placeholder="0.0" type="text" pattern="^[-+]?[0-9]*\.?[0-9]+$" class="form-control" required value= {{ old('valor_total')}}> {{ $errors->first('valor_total')}}
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="fornecedor_id" class="col-md-4 col-form-label text-md-right">{{ __('Fornecedor') }}</label>
                            @if(count($fornecedores) != 0 and count($fornecedores) != 0)
                            <div class="col-md-6">
                              <select class="form-control" id="fornecedores" name="fornecedor_id" required>
      								              <option value="">Selecione um Fornecedor</option>
      								              @foreach($fornecedores as $fornecedor)
      									            <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
      								              @endforeach
                              </select>
                            </div>
                            @else
                            <div class="col-md-6">
                              <select class="form-control" id="fornecedores" name="fornecedor_id" required>
      								              <option value="">Não há fornecedores cadastrados</option>
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
