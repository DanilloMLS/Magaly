@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm (' Deseja realmente excluir este estoque? ')) {
    location.href="/estoque/remover/"+id;
  }
  else {
    return false;
  }
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Estoques') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($estoques) == 0 and count($estoques) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum estoque cadastrado no sistema.
                      </div>
                      @else
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($estoques as $estoque)
                                <tr>
                                    <td data-title="Nome">{{ $estoque->nome }}</td>
                                    
                                    <td>
                                      <a class="btn btn-primary" href="/estoque/editar/{{$estoque->id}}">Entrada</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" href="/estoque/saida/{{$estoque->id}}">Saída</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" href="">Histórico</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" href="/estoque/exibirItensEstoque/{{$estoque->id}}">Itens</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar({{$estoque->id}});">Excluir</a>
                                    </td>
                                    {{-- <td>
                                      <button class="btn btn-primary" onClick="avisoDeletar({{$estoque->id}});" title="Excluir"><img class="btn-img" src="/img/wastebin.png" alt=""><div class="titulo-botao">Excluir</div></button>
                                    </td> --}}
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="{{URL::previous()}}">Voltar</a>

                      <a class="btn btn-primary" href="{{ route("/estoque/cadastrar") }}">Novo</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
