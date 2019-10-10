@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Escola') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/escola/salvar') }}">
                      <input type="hidden" name="id" value="{{ $escola->id}}" />
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome"  class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" readonly=“true” id="nome" type="text" class="form-control" required value="{{ $escola->nome}}" required value= {{ old('nome')}}> {{ $errors->first('nome')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade de ensino') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="modalidade_ensino" name="modalidade_ensino" required>
                                    <option value="">Selecione uma Modalidade de ensino</option>

                                    <option value="1" @if(strcasecmp($escola->modalidade_ensino, 'Creche Infantil Integral') == 0) selected="selected" @endif> Creche Infantil Integral</option>
                                    <option value="2" @if(strcasecmp($escola->modalidade_ensino, 'Creche Infantil Parcial') == 0) selected="selected" @endif>Creche Infantil Parcial</option>
                                    <option value="3" @if(strcasecmp($escola->modalidade_ensino, 'Infantil') == 0) selected="selected" @endif>Infantil</option>
                                    <option value="4" @if(strcasecmp($escola->modalidade_ensino, 'Ensino Fundamental') == 0) selected="selected" @endif>Ensino Fundamental</option>
                                    <option value="5" @if(strcasecmp($escola->modalidade_ensino, 'EJA') == 0) selected="selected" @endif>EJA</option>
                                    <option value="6" @if(strcasecmp($escola->modalidade_ensino, 'Quilombola') == 0) selected="selected" @endif>Quilombola</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="endereco" class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>

                            <div class="col-md-6">

                              <textarea name="endereco" id="endereco" type="text" class="form-control" required value= "{{ $escola->endereco}}"><?php echo $escola->endereco; ?></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="rota" class="col-md-4 col-form-label text-md-right">{{ __('Rota') }}</label>

                            <div class="col-md-6">

                              <textarea name="rota" id="rota" type="text" class="form-control" value= "{{ $escola->rota}}"><?php echo $escola->rota; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="periodo_atendimento" class="col-md-4 col-form-label text-md-right">{{ __('Período de atendimento') }}</label>

                            <div class="col-md-6">
                              <input name="periodo_atendimento" id="periodo_atendimento" type="text" class="form-control" required value="{{ $escola->periodo_atendimento}}" value= {{ old('periodo_atendimento')}}> {{ $errors->first('periodo_atendimento')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qtde_alunos" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade de alunos') }}</label>

                            <div class="col-md-6">
                              <input name="qtde_alunos" id="qtde_alunos" pattern="^[-+]?[0-9]*" type="text" class="form-control" value="{{ $escola->qtde_alunos}}" required value= {{ old('qtde_alunos')}}> {{ $errors->first('qtde_alunos')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gestor" class="col-md-4 col-form-label text-md-right">{{ __('Nome do gestor') }}</label>

                            <div class="col-md-6">
                              <input name="gestor" id="gestor" type="text" class="form-control" required value="{{ $escola->gestor}}" value= {{ old('gestor')}}> {{ $errors->first('gestor')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                            <div class="col-md-6">
                              <input name="telefone" id="telefone" type="text" class="form-control" value="{{ $escola->telefone}}" value= {{ old('telefone')}}> {{ $errors->first('telefone')}}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Salvar
                              </button>
                                <a class="btn-cancelar btn btn-primary" href="{{route ('/escola/listar')}}">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
