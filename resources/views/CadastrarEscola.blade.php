@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Escola') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/escola/cadastrar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" value= {{ old('nome')}}> {{ $errors->first('nome')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade de ensino') }}</label>

                              <div class="col-md-6">
                                <select class="form-control" id="modalidade_ensino" name="modalidade_ensino">
        								              <option value="">Selecione uma Modalidade de ensino</option>
        									            <option value="1">Creche Infantil Integral</option>
                                      <option value="2">Creche Infantil Parcial</option>
                                      <option value="3">Infantil</option>
                                      <option value="4">Ensino Fundamental</option>
                                      <option value="5">EJA</option>
                                      <option value="6">Quilombola</option>
                                </select>
                              </div>
                        </div>

                        <div class="form-group row">
                            <label for="endereco" class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>

                            <div class="col-md-6">
                              <textarea name="endereco" id="endereco" type="text" class="form-control" value= {{ old('endereco')}}> {{ $errors->first('endereco')}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="rota" class="col-md-4 col-form-label text-md-right">{{ __('Rota') }}</label>

                            <div class="col-md-6">
                              <textarea name="rota" id="rota" type="text" class="form-control" value= {{ old('rota')}}> {{ $errors->first('rota')}}</textarea>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="periodo_atendimento" class="col-md-4 col-form-label text-md-right">{{ __('Período de atendimento') }}</label>

                            <div class="col-md-6">
                              <input name="periodo_atendimento" id="periodo_atendimento" type="text" class="form-control" value= {{ old('periodo_atendimento')}}> {{ $errors->first('periodo_atendimento')}}</input>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qtde_alunos" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade de alunos') }}</label>

                            <div class="col-md-6">
                              <input name="qtde_alunos" id="qtde_alunos" type="text" type="text" placeholder="ex:100" pattern="^[-+]?[0-9]*" class="form-control" value= {{ old('qtde_alunos')}}> {{ $errors->first('qtde_alunos')}}</input>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gestor" class="col-md-4 col-form-label text-md-right">{{ __('Nome do gestor') }}</label>

                            <div class="col-md-6">
                              <input name="gestor" id="gestor" type="text" class="form-control" value= {{ old('gestor')}}> {{ $errors->first('gestor')}}</input>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                            <div class="col-md-6">
                              <input name="telefone" id="telefone" type="text" class="form-control" placeholder="(99)99999-9999" value= {{ old('telefone')}}> {{ $errors->first('telefone')}}</input>

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
