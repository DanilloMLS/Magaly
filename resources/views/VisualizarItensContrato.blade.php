@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Itens deste contrato') }}</div>

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
                              Não há nenhum item neste contrato.
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
                                  <th>Nº Lote</th>
                                  <th>Data de validade</th>
                                  <th>Descrição</th>
                                  <th>Gramatura</th>
                                  <th>Quantidade</th>
                                  <th>Valor unitário</th>
                                  <th>Subtotal</th>
                                  <th>Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($itens as $item_contrato)
                                <tr>
                                    @php
                                      $item = \App\Item::find($item_contrato->item_id);
                                    @endphp
                                    <td data-title="Nome">{{ $item->nome }}</td>
                                    <td data-title="Nº Lote">{{ $item_contrato->n_lote }}</td>
                                    <td data-title="Data de validade">{{ $item_contrato->data_validade }}</td>
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura."".$item->unidade }}</td>
                                    <td data-title="Quantidade">{{ $item_contrato->quantidade }}</td>
                                    <td data-title="Valor Unitario">R$ {{ $item_contrato->valor_unitario }}</td>
                                    <td data-title="Subtotal"> R$ {{ sprintf('%0.2f', $item_contrato->quantidade * $item_contrato->valor_unitario) }}</td>
                                    <td>
                                      <a title="Editar valor/qtde" class="btn btn-primary" href="{{ route ('/itemContrato/editar', ['contrato_id' => $item_contrato->contrato_id, 'contrato_item_id' => $item_contrato->id]) }}" >
                                        <img src="/img/item.png" height="21" width="21" align = "right">
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
                      <a class="btn btn-primary" href="{{ route ('/contrato/listar')}}">Voltar</a>
                      <a class="btn btn-primary" href="{{ route ('/contrato/inserirItemContrato', ['id' => $item_contrato->contrato_id])}}">Novo Item</a>
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
