@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Itens desta distribuição') }}</div>

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
                              Não há nenhum item nesta distribuição.
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
                                  <th>Gramatura</th>
                                  <th>Qtde. Danificados</th>
                                  <th>Qtde. Falta</th>
                                  <th>Quantidade Total</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($itens as $item_distribuicao)
                                <tr>
                                    @php
                                      $item = \App\Item::find($item_distribuicao->item_id);
                                    @endphp
                                    <td data-title="Nome">{{ $item->nome }}</td>
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}{{ $item->unidade }}</td>
                                    <td data-title="Qtde. Danificados">{{ $item_distribuicao->quantidade_danificados }}</td>
                                    <td data-title="Qtde. Falta">
                                      @if ($item_distribuicao->quantidade_falta >= 0)
                                        {{ $item_distribuicao->quantidade_falta }}
                                      @else
                                        {{"excesso ".$item_distribuicao->quantidade_falta*(-1) }}  
                                      @endif
                                      
                                    </td>
                                    <td data-title="Quantidade_total">{{ $item_distribuicao->quantidade_total }}</td>

                                    <td>
                                      <a title="Editar quantidade" class="btn btn-primary" href="{{ route ("/itemDistribuicao/editar", ['id' => $item_distribuicao->id])}}">
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
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="{{route ('/distribuicao/listar')}}">Voltar</a>
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
