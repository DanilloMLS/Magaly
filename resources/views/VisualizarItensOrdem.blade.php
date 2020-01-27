@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Itens desta ordem de fornecimento') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($ordem_itens) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum item nesta ordem de fornecimento.
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
                                  <th>Marca</th>
                                  <th>Descrição</th>
                                  <th>Gramatura</th>
                                  <th>Quantidade</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($ordem_itens as $ordem_item)
                                <tr>
                                    @php
                                      $contrato_item = \App\Contrato_item::find($ordem_item->contratoitem_id);
                                      $item = \App\Item::find($contrato_item->item_id);
                                    @endphp
                                    <td data-title="Nome">{{ $item->nome }}</td>
                                    <td data-title="Marca">{{ $item->marca }}</td>
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}{{ $item->unidade }}</td>
                                    <td data-title="Quantidade">{{ $ordem_item->quantidade_pedida }}</td>

                                    <td class="width4icons" align="left">
                                      <a title="Editar Item" class="btn btn-primary" href="{{route('/ordemfornecimento/editarOrdemItem',['id' => $ordem_item->id])}}">
                                        <img src="/img/edit.png" height="21" width="17">
                                      </a>
                                      <a title="Listar Ordens" class="btn btn-primary" href="{{route('/ordemfornecimento/listarOrdemServ',['id' => $ordem_item->id])}}">
                                        <img src="/img/order.png" height="21" width="17">
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
                      <a class="btn btn-primary" href="{{route ('/ordemfornecimento/listar')}}">Voltar</a>
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