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
                <div class="card-header">{{ __('Cadastrar Cardápio') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/cardapio/salvar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade de ensino') }}</label>
                            <div class="col-md-6">
                              <select required class="form-control" id="modalidade_ensino" name="modalidade_ensino">
                                    <option value="">Selecione uma Modalidade de ensino</option>
                                    <option value="1">Creche Infantil Integral</option>
                                    <option value="2">Creche Infantil Parcial</option>
                                    <option value="3">Infantil (pré-escola)</option>
                                    <option value="4">Ensino Fundamental</option>
                                    <option value="5">EJA</option>
                                    <option value="6">Quilombola</option>
                              </select>
                            </div>
                         </div>

                         <div class="form-group row">
                             <label for="data_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Data de início') }}</label>
                             <div class="col-md-2">
                               <input type="date" id="data_inicio" required class="form-control"  name="data_inicio">
                             </div>
                          </div>

                          <div class="form-group row">
                              <label for="data_fim" class="col-md-4 col-form-label text-md-right">{{ __('Data de fim') }}</label>
                              <div class="col-md-2">
                                <input type="date" id="data_fim" required class="form-control"  name="data_fim">
                              </div>
                           </div>

                           <div class="form-group row">
                               <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
                               <div class="col-md-6">
                                 <input id="nome" class="form-control" required name="nome">
                               </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                              <button type="submit" class="btn btn-primary">
                                  Inserir Refeições
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
