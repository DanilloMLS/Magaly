@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Contrato') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/contrato/salvar') }}">
                    <input type="hidden" name="id" value="{{ $contrato->id}}" />
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="data" class="col-md-4 col-form-label text-md-right">{{ __('Data ') }}</label>

                            <div class="col-md-6">
                              <input name="data" id="data" type="date" class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}" value="{{old('data', $contrato->data)}}">
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
                              <input name="n_contrato" id="n_contrato" type="text" class="form-control{{ $errors->has('n_contrato') ? ' is-invalid' : '' }}" value="{{old('n_contrato', $contrato->n_contrato)}}">
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
                              <input name="n_processo_licitatorio" id="n_processo_licitatorio" type="text" class="form-control{{ $errors->has('n_processo_licitatorio') ? ' is-invalid' : '' }}" value="{{old('n_processo_licitatorio', $contrato->n_processo_licitatorio)}}">
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
                            <input name="modalidade" id="modalidade" type="text" class="form-control{{ $errors->has('modalidade') ? ' is-invalid' : '' }}" value="{{old('modalidade', $contrato->modalidade)}}">
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
                              <textarea name="descricao" id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}">{{old('descricao', $contrato->descricao)}}</textarea>
                              @if ($errors->has('descricao'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="valor_total" class="col-md-4 col-form-label text-md-right">{{ __('Valor Total ') }}</label>

                            <div class="col-md-6">
                              <input name="valor_total" id="valor_total" type="text" class="form-control{{ $errors->has('valor_total') ? ' is-invalid' : '' }}" value="{{old('valor_total', $contrato->valor_total)}}">
                              @if ($errors->has('valor_total'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('valor_total') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fornecedor_id" class="col-md-4 col-form-label text-md-right">{{ __('Fornecedor') }}</label>
                            @if(count($fornecedores) != 0 and count($fornecedores) != 0)
                            @php
                                $fornecedor_nome = \App\Fornecedor::find($contrato->fornecedor_id);
                            @endphp
                            <div class="col-md-6">
                              <select class="form-control{{ $errors->has('fornecedor_id') ? ' is-invalid' : '' }}" id="fornecedores" name="fornecedor_id">
      								              <option value="{{$contrato->fornecedor_id}}">{{$fornecedor_nome->nome}}</option>
                                                  
      								              @foreach($fornecedores as $fornecedor)
      									              <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
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
                                  Salvar
                              </button>
                                <a class="btn-cancelar btn btn-primary" href="{{route ('/contrato/listar')}}">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection