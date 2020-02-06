@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm (' Deseja realmente excluir esta ordem de fornecimento? ')) {
    location.href="/ordemfornecimento/remover/"+id;
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
                <div class="card-header">{{ __('Ordens de Fornecimento') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($ordem_fornecimentos) == 0)
                      <div class="alert alert-danger">
                              Não há ordens de fornecimento cadastradas no sistema.
                      </div>
                      @else
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                          <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Contrato</th>
                                  <th>Observação</th>
                                  <th>Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($ordem_fornecimentos as $ordem_fornecimento)
                                <tr>
                                    <td data-title="Id">{{ $ordem_fornecimento->id }}</td>
                                    <?php $contrato = \App\Contrato::find($ordem_fornecimento->contrato_id)?>
                                    <td class="width15" data-title="Contrato">{{ $contrato->n_contrato }}</td>
                                    <td data-title="Observação" align="justify">{{ $ordem_fornecimento->observacao }}</td>

                                    <td class="width4icons" align="left">
                                      <a title="Listar Itens" class="btn btn-primary" href="{{route("/ordemfornecimento/listarItensOrdem", ['id' => $ordem_fornecimento->id])}}">
                                        <img src="/img/item.png" class="tamIconsPadrao">
                                      </a>
                                      <a title="Editar Ordem" class="btn btn-primary" href="{{route("/ordemfornecimento/editarOrdem", ['id' => $ordem_fornecimento->id])}}">
                                        <img src="/img/edit.png" class="tamIconsPadrao">
                                      </a>
                                      @if ($ordem_fornecimento->ehcompleta == FALSE)
                                        <a title="Dar Baixa" class="btn btn-primary" href="{{route("/ordemfornecimento/novaBaixa", ['id' => $ordem_fornecimento->id])}}">
                                          <img src="/img/rec_order.png" class="tamIconsPadrao">
                                        </a>
                                      @endif
                                      <a title="Imprimir Ordem" class="btn btn-primary" href="{{route("/ordemfornecimento/imprimir", ['ordem_fornecimento_id' => $ordem_fornecimento->id])}}">
                                        <img src="/img/down.png" class="tamIconsPadrao">
                                      </a>
                                    </td>
                                    
                                    {{-- @if (Auth::guard()->check() && Auth::user()->is_adm)
                                      <td class="width4icons" align="right">
                                        <a title="Exibir Itens" class="btn btn-primary" href="{{ route ("/distribuicao/exibirItensDistribuicao", ['id' => $distribuicao->id])}}">
                                          <img src="/img/item.png" class="tamIconsPadrao">
                                        </a>
                                        <a title="Remover" class="btn btn-primary" onClick="avisoDeletar({{$distribuicao->id}});">
                                          <img class="tamIconsPadrao" src="/img/delete.png" >
                                        </a>
                                        @if ($distribuicao->baixada == false)
                                          <a title="Dar baixa" class="btn btn-primary" href="{{ route("/distribuicao/novaBaixa", ['id' => $distribuicao->id]) }}">
                                            <img src="/img/down_arrow.png" class="tamIconsPadrao">
                                          </a>
                                        @endif
                                        <a title="Visualizar" class="btn btn-primary" target="_blank" href="{{ route ("/distribuicao/RelatorioDistribuicoes", ['token' => $distribuicao->token])}}">
                                          <img src="/img/down.png" class="tamIconsPadrao">
                                        </a>
                                      </td>
                                    @endif --}}
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
