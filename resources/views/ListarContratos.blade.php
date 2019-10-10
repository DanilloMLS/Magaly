@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contratos') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($contratos) == 0 and count($contratos) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum contrato cadastrado no sistema.
                      </div>
                      @else
                      <div id= "termoBusca" style="display: flex; justify-content: space-between">
                          <div>
                            <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca Simples">
                            <a class="btn btn-primary" href ="{{ route("/contrato/buscar") }}">
                                <img src="/img/search.png" height="23" width="21" align = "right">
                                Detalhada
                            </a>
                          </div>
                      </div>
                          <br>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Fornecedor</th>
                                  <th>Nº Contrato</th>
                                  <th>Nº Processo</th>
                                  <th>Modalidade</th>
                                  <th>Descrição</th>
                                  <th>Data</th>
                                  <th>Valor Total</th>
                                  <th>Valor Restante</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($contratos as $contrato)
                                <tr>
                                    <?php $fornecedor = \App\Fornecedor::find($contrato->fornecedor_id)?>
                                    <td data-title="Fornecedor">{{ $fornecedor->nome }}</td>
                                    <td data-title="N_contrato">{{ $contrato->n_contrato }}</td>
                                    <td data-title="N_processo">{{ $contrato->n_processo_licitatorio }}</td>
                                    <td data-title="Modalidade">{{ $contrato->modalidade }}</td>
                                    <td data-title="Descricao">{{ $contrato->descricao }}</td>
                                    <td data-title="Data">{{ $contrato->data }}</td>
                                    <td data-title="valor_total">
                                      @php
                                          echo "R$".number_format($contrato->valor_total,2,',','.');
                                      @endphp
                                      </td>
                                    <td data-title="valor_restante">
                                      @php
                                          $contrato_itens = \App\Contrato_item::where('contrato_id','=',$contrato->id)->get();
                                          $valor_restante = 0.0;

                                          foreach ($contrato_itens as $contrato_item) {
                                            $valor_restante += $contrato_item->valor_unitario * $contrato_item->quantidade;
                                          }
                                          echo "R$".number_format($valor_restante,2,',','.');
                                      @endphp
                                      </td>
                                    <td data-title="Ações">
                                      <a title="Ver Itens" class="btn btn-primary" href="{{ route ("/contrato/exibirItensContrato", ['id' => $contrato->id])}}" >
                                        <img src="/img/item.png" height="24" width="21" align = "right">
                                      </a>
                                      
                                    </td>
                                    <td>
                                      <a title="Editar Contrato" class="btn btn-primary" href="{{ route ("/contrato/editar", ['id' => $contrato->id])}}">
                                        <img src="/img/edit.png" height="21" width="21" align = "center">
                                      </a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" href="{{ route ('/contrato/inserirItemContrato', ['id' => $contrato->id])}}">
                                        <img src="/img/add_item.png" height="21" width="21" align = "center">
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

                      <a class="btn btn-primary" href="{{ route("/contrato/telaCadastrar") }}">Novo</a>
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
