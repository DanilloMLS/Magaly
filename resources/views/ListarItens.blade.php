@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm (' Deseja realmente excluir este item? ')) {
    location.href="/item/remover/"+id;
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
                <div class="card-header">{{ __('Itens') }}</div>
                <div class="card-body">
                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($itens) == 0 and count($itens) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum item cadastrado no sistema.
                      </div>
                      @else
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Data de validade</th>
                                  <th>Nº lote</th>
                                  <th>Descrição</th>
                                  <th>Unidade</th>
                                  <th>Gramatura</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($itens as $item)
                                <tr>
                                    <td data-title="Valor unitário">{{ $item->nome }}</td>
                                    <td data-title="Data de validade">{{ $item->data_validade }}</td>
                                    <td data-title="Nº lote">{{ $item->n_lote }}</td>
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Unidade">{{ $item->unidade }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}</td>

                                    </td>
                                    <!-- A exclusão deve ser feita apenas pelo controle de estoque -->
                                    <!-- <td>
                                      <a class="btn btn-primary" href="/item/editar/{{$item->id}}">Editar</a>
                                    </td> -->
                                    <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar({{$item->id}});"> Excluir</a>
                                    </td>
                                    <td></td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="{{URL::previous()}}">Voltar</a>
                      <a class="btn btn-primary" target="_blank" href="{{ route("/item/RelatorioItens") }}">Relatório</a>
                      <a class="btn btn-primary" href="{{ route("/item/telaCadastrar") }}">Novo</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
