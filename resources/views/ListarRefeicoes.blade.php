@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Refeições') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($refeicoes) == 0 and count($refeicoes) == 0)
                      <div class="alert alert-danger">
                              Não há nenhuma refeição cadastrada no sistema.
                      </div>
                      @else
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Descrição</th>
                                  <th>Peso líquido</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($refeicoes as $refeicao)
                                <tr>
                                    <td data-title="Nome">{{ $refeicao->nome }}</td>
                                    <td data-title="Descricao">{{ $refeicao->descricao }}</td>
                                    <td data-title="Peso_liquido">{{ $refeicao->peso_liquido }}</td>

                                    <td>
                                      <a class="btn btn-primary" href="/refeicao/exibirItensRefeicao/{{$refeicao->id}}">Itens</a>
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

                      <a class="btn btn-primary" href="{{ route("/refeicao/cadastrar") }}">Novo</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
