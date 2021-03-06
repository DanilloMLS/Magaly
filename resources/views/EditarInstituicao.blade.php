@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Instituição') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/instituicao/salvar') }}">
                      <input type="hidden" name="id" value="{{ $instituicao->id}}" />
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome"  class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{old('nome', $instituicao->nome)}}" autofocus>
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

                                    <option value="1" @if(strcasecmp($instituicao->modalidade_ensino, 'Creche Infantil Integral') == 0) selected="selected" @endif> Creche Infantil Integral</option>
                                    <option value="2" @if(strcasecmp($instituicao->modalidade_ensino, 'Creche Infantil Parcial') == 0) selected="selected" @endif>Creche Infantil Parcial</option>
                                    <option value="3" @if(strcasecmp($instituicao->modalidade_ensino, 'Infantil') == 0) selected="selected" @endif>Infantil</option>
                                    <option value="4" @if(strcasecmp($instituicao->modalidade_ensino, 'Ensino Fundamental') == 0) selected="selected" @endif>Ensino Fundamental</option>
                                    <option value="5" @if(strcasecmp($instituicao->modalidade_ensino, 'EJA') == 0) selected="selected" @endif>EJA</option>
                                    <option value="6" @if(strcasecmp($instituicao->modalidade_ensino, 'Quilombola') == 0) selected="selected" @endif>Quilombola</option>
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

                              <textarea name="endereco" id="endereco" type="text" class="form-control{{ $errors->has('endereco') ? ' is-invalid' : '' }}" >{{old('endereco', $instituicao->endereco)}}</textarea>
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

                              <textarea name="rota" id="rota" type="text" class="form-control{{ $errors->has('rota') ? ' is-invalid' : '' }}" >{{old('rota', $instituicao->rota)}}</textarea>
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
                              <input name="periodo_atendimento" id="periodo_atendimento" type="text" class="form-control{{ $errors->has('periodo_atendimento') ? ' is-invalid' : '' }}" value="{{old('periodo_atendimento', $instituicao->periodo_atendimento)}}">
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
                              <input name="qtde_alunos" id="qtde_alunos" type="text" class="form-control{{ $errors->has('qtde_alunos') ? ' is-invalid' : '' }}" value= "{{ old('qtde_alunos', $instituicao->qtde_alunos)}}">
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
                              <input name="gestor" id="gestor" type="text" class="form-control{{ $errors->has('gestor') ? ' is-invalid' : '' }}" value= "{{ old('gestor', $instituicao->gestor)}}">
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
                              <input name="telefone" id="telefone" type="text" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" value= "{{ old('telefone', $instituicao->telefone)}}">
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
                                  Salvar
                              </button>
                                <a class="btn-cancelar btn btn-primary" href="{{route ('/instituicao/listar')}}">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
