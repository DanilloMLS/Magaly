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
                          <br>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>CNPJ</th>
                                  <th>Telefone</th>
                                  <th>Email</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($fornecedores as $fornecedor)
                                <tr>
                                    <td data-title="Nome">{{ $fornecedor->nome }}</td>
                                    <td data-title="CNPJ">{{ $fornecedor->cnpj }}</td>
                                    <td data-title="Telefone">{{ $fornecedor->telefone }}</td>
                                    <td data-title="Email">{{ $fornecedor->email }}</td>

                                    @if (Auth::guard()->check() && Auth::user()->is_adm)
                                      <td align="right">
                                        <a class="btn btn-primary" title="Editar fornecedor" href="{{ route ("/fornecedor/editar", ['id' => $fornecedor->id])}}">
                                          <img src="/img/edit.png" class="tamIconsPadrao">
                                        </a>
                                        <a class="btn btn-primary" title="Ordem de Fornecimento" href="{{ route ("/ordemfornecimento/telaCadastrar", ['id' => $fornecedor->id])}}">
                                          <img src="/img/down_arrow.png" class="tamIconsPadrao">
                                        </a>
                                      </td>
                                    @endif
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
