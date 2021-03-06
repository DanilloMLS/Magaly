@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm (' Deseja realmente excluir esta distribuição? ')) {
    location.href="/distribuicao/remover/"+id;
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
                <div class="card-header">{{ __('Distribuições') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($distribuicoes) == 0 and count($distribuicoes) == 0)
                      <div class="alert alert-danger">
                              Não há nenhuma distribuição cadastrada no sistema.
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
                                  <th>Instituicao</th>
                                  <th>Observação</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($distribuicoes as $distribuicao)
                                <tr>
                                    <td data-title="Id">{{ $distribuicao->id }}</td>
                                    <?php $instituicao = \App\Instituicao::find($distribuicao->instituicao_id)?>
                                    <td class="width15" data-title="Modalidade de Ensino">{{ $instituicao->nome }}</td>
                                    <td data-title="Observação" align="justify">{{ $distribuicao->observacao }}</td>

                                    @if (Auth::guard()->check() && Auth::user()->tipo_user == 'adm')
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
