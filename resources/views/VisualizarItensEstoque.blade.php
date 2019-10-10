@extends('layouts.app')

@section('content')

<script language= 'javascript'>
  function avisoDeletar(id){
    if(confirm (' Deseja realmente excluir este item? ')) {
      location.href="/estoque/removerItem/"+id;
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
                <div class="card-header">{{ __('Itens deste estoque') }}</div>

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
                              Não há nenhum item neste estoque.
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
                                  <th>Descrição</th>
                                  <th>Data de Validade</th>
                                  <th>Nº Lote</th>
                                  <th>Nº de Contrato</th>
                                  <th>Unidade</th>
                                  <th>Gramatura</th>
                                  <th>Danificados</th>
                                  <th>Quantidade disponível</th>
                                  <th>Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($itens as $item_estoque)
                                <tr>
                                    @php
                                      $item = \App\Item::find($item_estoque->item_id);
                                      $contrato_item = \App\Contrato_item::where('item_id','=',$item_estoque->item_id)->first();
                                      $contrato = \App\Contrato::where('id','=',$contrato_item->contrato_id)->first();
                                    @endphp
                                    <td data-title="Valor unitário">{{ $item->nome }}</td>
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Data de Validade">{{$item_estoque->data_validade}}</td>
                                    <td data-title="Nº Lote">{{$item_estoque->n_lote}}</td>
                                    <td data-title="Nº de Contrato">{{$contrato->n_contrato}}</td>
                                    <td data-title="Unidade">{{ $item->unidade }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}</td>
                                    <td data-title="Danificados">{{ $item_estoque->quantidade_danificados}}</td>
                                    <td data-title="Quantidade disponível">{{ $item_estoque->quantidade }}</td>

                                    <td>
                                        <a class="btn btn-primary" title="Entrada de Item" href="{{ route ("/estoque/inserirEntrada", ['id' => $item_estoque->id])}}">
                                          <img src="/img/entrance.png" height="21" width="17" align = "right">                                          
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" title="Saída de Item" href="{{ route ("/estoque/inserirSaida", ['id' => $item_estoque->id])}}">
                                          <img src="/img/exit.png" height="21" width="17" align = "right">                                          
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" title="Deletar Item" onClick="avisoDeletar({{$item_estoque->id}});">
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
                      <a class="btn btn-primary" href="{{route ('/estoque/listar')}}">Voltar</a>
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
