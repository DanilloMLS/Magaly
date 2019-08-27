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

function editar(id){
  location.href="/item/editar/"+id;
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
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Marca</th>
                                  <th>Descrição</th>
                                  <th>Unidade</th>
                                  <th>Gramatura</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($itens as $item)
                                <tr title="Clique para editar" onclick="editar({{$item->id}});">
                                    <td data-title="Nome">{{ $item->nome }}</td>
                                    <td data-title="Marca">{{ $item->marca }}</td>
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Unidade">{{ $item->unidade }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}</td>

                                    </td>
                                    <!-- A exclusão deve ser feita apenas pelo controle de estoque -->
                                    <!-- <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar({{$item->id}});"> Excluir</a>
                                    </td> -->
                                    <td></td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                          {{$itens->links()}}
                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" target="_blank" href="{{ route("/item/RelatorioItens") }}">Relatório</a>
                      <a class="btn btn-primary" href="{{ route("/item/telaCadastrar") }}">Novo</a>
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
