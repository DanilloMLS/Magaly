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
                    </div>
                  @endif
                  @if (\Session::has('warning'))
                    <div class="alert alert-warning" role="alert">
                        {!! \Session::get('warning') !!}
                    </div>
                  @endif
                  <div class="panel-body">
                      @if(count($estoques) == 0 and count($estoques) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum estoque cadastrado no sistema.
                      </div>
                      @else
                      <div id= "termoBusca" style="display: flex; justify-content: space-between">
                          <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th class="width">Id</th>
                                  <th >Nome</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($estoques as $estoque)
                                <tr>
                                    <td class="width20px" data-title="Id" title="Clique para listar os itens" >{{ $estoque->id }}</td>
                                    <td data-title="Nome" title="Clique para listar os itens" >{{ $estoque->nome }}</td>
                                    @if (Auth::guard()->check() && Auth::user()->is_adm)
                                      <td class="width3icons" align="right" >
                                        <a title="Listar Ítens" class="btn btn-primary" onClick="listarItens({{$estoque->id}});">
                                          <img src="/img/item.png" class="tamIconsPadrao">
                                        </a>
                                        <a title="Inserir Novo Item" class="btn btn-primary" href="{{ route ("/estoque/novoItemEstoque", ['id' => $estoque->id])}}">
                                          <img src="/img/add_item.png" class="tamIconsPadrao">
                                        </a>
                                        <a title="Renomear Estoque" class="btn btn-primary" onClick="renomear({{$estoque->id}});">
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
