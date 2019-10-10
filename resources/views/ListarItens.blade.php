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
                        <div id="tabela" class="table-responsive">
                            <div id= "termoBusca" style="display: flex; justify-content: space-between">
                                <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                            </div>
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Marca</th>
                                  <th>Descrição</th>
                                  <th>Gramatura</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($itens as $item)
                                <tr>
                                    <td data-title="Nome">{{ $item->nome }}</td>
                                    <td data-title="Marca">{{ $item->marca }}</td>
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}{{ $item->unidade }}</td>

                                    </td>

                                    <td>
                                        <a class="btn btn-primary" href="{{ route ("/item/editar", ['id' => $item->id])}}">
                                            <img src="/img/edit.png" height="21" width="17" align = "right">
                                        </a>
                                    </td>
                                    <td></td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      @endif
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
