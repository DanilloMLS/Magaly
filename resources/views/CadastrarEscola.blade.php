@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Escola') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/escola/cadastrar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value= "{{ old('nome')}}">
                              @if ($errors->has('nome'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade de ensino') }}</label>

                              <div class="col-md-6">
                                <select class="form-control{{ $errors->has('modalidade_ensino') ? ' is-invalid' : '' }}" id="modalidade_ensino" name="modalidade_ensino">
        								<option value="">Selecione uma Modalidade de ensino</option>
        							    <option value="1" {{ old('modalidade_ensino') == 1 ? 'selected' : '' }}>Creche Infantil Integral</option>
                                        <option value="2" {{ old('modalidade_ensino') == 2 ? 'selected' : '' }}>Creche Infantil Parcial</option>
                                        <option value="3" {{ old('modalidade_ensino') == 3 ? 'selected' : '' }}>Infantil</option>
                                        <option value="4" {{ old('modalidade_ensino') == 4 ? 'selected' : '' }}>Ensino Fundamental</option>
                                        <option value="5" {{ old('modalidade_ensino') == 5 ? 'selected' : '' }}>EJA</option>
                                        <option value="6" {{ old('modalidade_ensino') == 6 ? 'selected' : '' }}>Quilombola</option>
                                </select>
                                @if ($errors->has('modalidade_ensino'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('modalidade_ensino') }}</strong>
                                    </span>
                                @endif
                              </div>
                        </div>

                        <div class="form-group row">
                            <label for="endereco" class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>

                            <div class="col-md-6">
                              <textarea name="endereco" id="endereco" type="text" class="form-control{{ $errors->has('endereco') ? ' is-invalid' : '' }}" >{{ old('endereco')}}</textarea>
                              @if ($errors->has('endereco'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('endereco') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="rota" class="col-md-4 col-form-label text-md-right">{{ __('Rota') }}</label>

                            <div class="col-md-6">
                              <textarea name="rota" id="rota" type="text" class="form-control{{ $errors->has('rota') ? ' is-invalid' : '' }}" >{{ old('rota')}}</textarea>
                              @if ($errors->has('rota'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rota') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="periodo_atendimento" class="col-md-4 col-form-label text-md-right">{{ __('Período de atendimento') }}</label>

                            <div class="col-md-6">
                              <input name="periodo_atendimento" id="periodo_atendimento" type="text" class="form-control{{ $errors->has('periodo_atendimento') ? ' is-invalid' : '' }}" value= "{{ old('periodo_atendimento')}}">
                              @if ($errors->has('periodo_atendimento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('periodo_atendimento') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qtde_alunos" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade de alunos') }}</label>

                            <div class="col-md-6">
                              <input name="qtde_alunos" id="qtde_alunos" type="text" type="text" placeholder="ex:100" class="form-control{{ $errors->has('qtde_alunos') ? ' is-invalid' : '' }}" value= "{{ old('qtde_alunos')}}"></input>
                              @if ($errors->has('qtde_alunos'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('qtde_alunos') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gestor" class="col-md-4 col-form-label text-md-right">{{ __('Nome do gestor') }}</label>

                            <div class="col-md-6">
                              <input name="gestor" id="gestor" type="text" class="form-control{{ $errors->has('gestor') ? ' is-invalid' : '' }}" value= "{{ old('gestor')}}">
                              @if ($errors->has('gestor'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gestor') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                            <div class="col-md-6">
                              <input name="telefone" id="telefone" type="text" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" placeholder="Somente dígitos, DDD sem zero" value= "{{ old('telefone')}}">
                              @if ($errors->has('telefone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefone') }}</strong>
                                    </span>
                              @endif
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
