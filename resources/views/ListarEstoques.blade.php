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

function renomear(id){
  location.href="/estoque/editar/"+id;
}

function listarItens(id){
  location.href="/estoque/exibirItensEstoque/"+id;
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
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                        <div id="tabela" class="table-responsive">
                          <h5 class="card-title">
                            Exibindo {{$estoques->count()}} estoques de {{$estoques->total()}} 
                            ({{$estoques->firstItem()}} a {{$estoques->lastItem()}})
                          </h5>
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th >Nome</th>
                                  <th align="center">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($estoques as $estoque)
                                <tr>
                                    <td data-title="Nome" title="Clique para listar os itens" onClick="listarItens({{$estoque->id}});">{{ $estoque->nome }}</td>
                                    <td>
                                      <a title="Inserir Novo Item" class="btn btn-primary" href="{{ route ("/estoque/novoItemEstoque", ['id' => $estoque->id])}}">
                                        <img src="/img/add_item.png" height="21" width="21" align = "right">
                                      </a>
                                      <a title="Histórico de Movimentações" class="btn btn-primary" href="{{ route ("/estoque/historicoEstoque", ['id' => $estoque->id])}}">
                                        <img src="/img/history.png" height="21" width="21" align = "right">
                                      </a>
                                      <a title="Remover Estoque" class="btn btn-primary" onClick="avisoDeletar({{$estoque->id}});">
                                        <img src="/img/delete.png" height="21" width="17" align = "right">
                                      </a>
                                      <a title="Renomear" class="btn btn-primary" onClick="renomear({{$estoque->id}});">
                                        <img src="/img/edit.png" height="21" width="17" align = "right">
                                      </a>
                                    </td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                          {{$estoques->links()}}
                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" target="_blank" href="{{ route("/estoque/RelatorioEstoques") }}">Relatório</a>

                      <a class="btn btn-primary" href="{{ route("/estoque/cadastrar") }}">Novo</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function buscar() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("termo");
      filter = input.value.toUpperCase();
      table = document.getElementById("tabela");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>
@endsection
