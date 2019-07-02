@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cardápios') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($cardapios) == 0 and count($cardapios) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum cardápio cadastrado no sistema.
                      </div>
                      @else
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Modalidade de Ensino</th>
                                  <th>Data de início</th>
                                  <th>Data de fim</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($cardapios as $cardapio)
                                <tr>
                                    <td data-title="Nome">{{ $cardapio->nome }}</td>
                                    <td data-title="Modalidade">{{ $cardapio->modalidade_ensino }}</td>
                                    <td data-title="Data_inicio">{{ $cardapio->data_inicio }}</td>
                                    <td data-title="Data_fim">{{ $cardapio->data_fim }}</td>

                                    <td>
                                      <a class="btn btn-primary" href="">ver</a>
                                    </td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="{{URL::previous()}}">Voltar</a>

                      <a class="btn btn-primary" href="{{ route("/cardapio/cadastrar") }}">Novo</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
