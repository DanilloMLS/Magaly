@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm ('Esta ação removerá do sistema todas as distribuições dessa escola. Deseja realmente excluí-la? ')) {
    location.href="/escola/remover/"+id;
  }
  else {
    return false;
  }
}

function editar(id){
  location.href="/escola/editar/"+id;
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Escolas') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($escolas) == 0 and count($escolas) == 0)
                      <div class="alert alert-danger">
                              Não há nenhuma escola cadastrada no sistema.
                      </div>
                      @else
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nº</th>
                                  <th>Nome</th>
                                  <th>Modalidade de Ensino</th>
                                  <th>Rota</th>
                                  <th>Endereço</th>
                                  <th>Período de Atendimento</th>
                                  <th>Quantidade de Alunos</th>
                                  <th>Gestor</th>
                                  <th>Telefone</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($escolas as $escola)
                                <tr>
                                    <td data-title="Nº" title="Clique para editar" onclick="editar({{$escola->id}});">{{ $escola->id }}</td>
                                    <td data-title="Nome" title="Clique para editar" onclick="editar({{$escola->id}});">{{ $escola->nome }}</td>
                                    <td data-title="Modalidade de Ensino">{{ $escola->modalidade_ensino }}</td>
                                    <td data-title="Rota">{{ $escola->rota }}</td>
                                    <td data-title="Endereco">{{ $escola->endereco }}</td>
                                    <td data-title="Período de Atendimento">{{ $escola->periodo_atendimento }}</td>
                                    <td data-title="Quantidade de Alunos">{{ $escola->qtde_alunos }}</td>
                                    <td data-title="Gestor">{{ $escola->gestor }}</td>
                                    <td data-title="Telefone">{{ $escola->telefone }}</td>


                                    <td>
                                      <a class="btn btn-primary" href="{{ route ("/escola/editar", ['id' => $escola->id])}}">
                                        <img src="/img/edit.png" height="21" width="17" align = "right">
                                      </a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar({{$escola->id}});">
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
                      <a class="btn btn-primary" target="_blank" href="{{ route("/escola/RelatorioEscolas") }}">Relatório</a>
                      <a class="btn btn-primary" href="{{ route("/escola/cadastrar") }}">Nova</a>
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
        td_id = tr[i].getElementsByTagName("td")[0];
        td_nome = tr[i].getElementsByTagName("td")[1];
        if (td_nome || td_id) {
          txtValue = td_nome.textContent || td_nome.innerText;
          txtValue1 = td_id.textContent || td_id.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>
@endsection
