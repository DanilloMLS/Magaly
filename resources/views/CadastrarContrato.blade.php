@extends('layouts.app')

@section('content')

<script type="text/javascript">
    function pegarDataAtual(){
        data = new Date();
        document.getElementById('data').value = data.getDay()+'/'+data.getMonth()+'/'+data.getFullYear();
    }
</script>

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
                              <input name="data" id="data" type="date" class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}" value="<?php echo date('Y-m-d'); ?>">
                              @if ($errors->has('data'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('data') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="n_contrato" class="col-md-4 col-form-label text-md-right">{{ __('Nº Contrato ') }}</label>

                            <div class="col-md-6">
                              <input name="n_contrato" id="n_contrato" type="text" class="form-control{{ $errors->has('n_contrato') ? ' is-invalid' : '' }}" value="{{ old('n_contrato')}}">
                              @if ($errors->has('n_contrato'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('n_contrato') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="n_processo_licitatorio" class="col-md-4 col-form-label text-md-right">{{ __('Nº Processo Licitatório ') }}</label>

                            <div class="col-md-6">
                              <input name="n_processo_licitatorio" id="n_processo_licitatorio" type="text" class="form-control{{ $errors->has('n_processo_licitatorio') ? ' is-invalid' : '' }}" value="{{ old('n_processo_licitatorio')}}">
                              @if ($errors->has('n_processo_licitatorio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('n_processo_licitatorio') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="modalidade" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade ') }}</label>

                          <div class="col-md-6">
                            <input name="modalidade" id="modalidade" type="text" class="form-control{{ $errors->has('modalidade') ? ' is-invalid' : '' }}" value="{{ old('n_processo_licitatorio')}}">
                            @if ($errors->has('modalidade'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('modalidade') }}</strong>
                                    </span>
                              @endif
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição ') }}</label>

                            <div class="col-md-6">
                              <textarea name="descricao" id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}">{{ old('descricao')}}</textarea>
                              @if ($errors->has('descricao'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fornecedor_id" class="col-md-4 col-form-label text-md-right">{{ __('Fornecedor') }}</label>
                            @if(count($fornecedores) != 0 and count($fornecedores) != 0)
                            <div class="col-md-6">
                              <select class="form-control{{ $errors->has('fornecedor_id') ? ' is-invalid' : '' }}" id="fornecedores" name="fornecedor_id">
      								              <option value="">Selecione um Fornecedor</option>
      								              @foreach($fornecedores as $fornecedor)
      									            <option value="{{$fornecedor->id}}" {{ old('fornecedor_id') == $fornecedor->id ? 'selected' : '' }}>{{$fornecedor->nome}}</option>
      								              @endforeach
                              </select>
                              @if ($errors->has('fornecedor_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fornecedor_id') }}</strong>
                                    </span>
                              @endif
                            </div>
                            @else
                            <div class="col-md-6">
                              <select class="form-control{{ $errors->has('fornecedor_id') ? ' is-invalid' : '' }}" id="fornecedores" name="fornecedor_id">
      								              <option value="">Não há fornecedores cadastrados</option>
                              </select>
                              @if ($errors->has('fornecedor_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fornecedor_id') }}</strong>
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
