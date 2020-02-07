@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm ('Esta ação removerá do sistema todas as distribuições dessa instituicao. Deseja realmente excluí-la? ')) {
    location.href="/instituicao/remover/"+id;
  }
  else {
    return false;
  }
}

function editar(id){
  location.href="/instituicao/editar/"+id;
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Instituicaos') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($instituicaos) == 0 and count($instituicaos) == 0)
                      <div class="alert alert-danger">
                              Não há nenhuma instituicao cadastrada no sistema.
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
                                  <th>Nº</th>
                                  <th>Nome</th>
                                  <th>Modalidade de Ensino</th>
                                  <th>Rota</th>
                                  <th>Endereço</th>
                                  <th>Período de Atendimento</th>
                                  <th>Quantidade de Alunos</th>
                                  <th>Gestor</th>
                                  <th>Telefone</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($instituicaos as $instituicao)
                                <tr>
                                    <td data-title="Nº">{{ $instituicao->id }}</td>
                                    <td data-title="Nome">{{ $instituicao->nome }}</td>
                                    <td data-title="Modalidade de Ensino">{{ $instituicao->modalidade_ensino }}</td>
                                    <td data-title="Rota">{{ $instituicao->rota }}</td>
                                    <td data-title="Endereco">{{ $instituicao->endereco }}</td>
                                    <td data-title="Período de Atendimento">{{ $instituicao->periodo_atendimento }}</td>
                                    <td data-title="Quantidade de Alunos">{{ $instituicao->qtde_alunos }}</td>
                                    <td data-title="Gestor">{{ $instituicao->gestor }}</td>
                                    <td data-title="Telefone">{{ $instituicao->telefone }}</td>

                                    @if (Auth::guard()->check() && Auth::user()->tipo_user == 'adm')
                                      <td align="right">
                                        <a title="Editar instituicao" class="btn btn-primary" href="{{ route ("/instituicao/editar", ['id' => $instituicao->id])}}">
                                          <img src="/img/edit.png" class="tamIconsPadrao">
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
