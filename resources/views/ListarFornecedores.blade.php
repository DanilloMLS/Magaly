@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm ('Esta ação removerá do sistema todos os contratos deste fornecedor. Deseja realmente excluí-lo? ')) {
    location.href="/fornecedor/remover/"+id;
  }
  else {
    return false;
  }
}

function editar(id){
  location.href="/fornecedor/editar/"+id;
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Fornecedores') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($fornecedores) == 0 and count($fornecedores) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum fornecedor cadastrado no sistema.
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
                                  <th>CNPJ</th>
                                  <th>Telefone</th>
                                  <th>Email</th>
                                  <th>Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($fornecedores as $fornecedor)
                                <tr>
                                    <td data-title="Nome">{{ $fornecedor->nome }}</td>
                                    <td data-title="CNPJ">{{ $fornecedor->cnpj }}</td>
                                    <td data-title="Telefone">{{ $fornecedor->telefone }}</td>
                                    <td data-title="Telefone">{{ $fornecedor->email }}</td>

                                    <td>
                                      <a class="btn btn-primary" href="/fornecedor/editar/{{$fornecedor->id}}">
                                        <img src="/img/edit.png" height="21" width="17" align = "right">
                                      </a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar({{$fornecedor->id}});">
                                        <img src="/img/delete.png" height="21" width="17" align = "right">
                                      </a>
                                    </td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" target="_blank" href="{{ route("/fornecedor/RelatorioFornecedores") }}">Relatório</a>
                      <a class="btn btn-primary" href="{{ route("/fornecedor/cadastrar") }}">Novo</a>
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
