@extends('layouts.app')

@section('content')

<script language= 'javascript'>
    function avisoBaixa(id){
      if(confirm (' Deseja realmente dar baixa? ')) {
        location.href="/ordemfornecimento/concluirBaixa/"+id;
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
                <div class="card-header">{{ __('Baixa Ordem de Fornecimento - Lista de Itens') }}</div>

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
                              Não há itens nesta ordem de fornecimento.
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
                                  <th>Qtde. Pedida</th>
                                  <th>Qtde. Aceita</th>
                                  <th>Qtde. Restante</th>
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
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}{{ $item->unidade }}</td>
                                    <td data-title="Qtde. Pedida">{{ $ordem_item->quantidade_pedida }}</td>
                                    <td data-title="Qtde. Aceita">{{ $ordem_item->quantidade_aceita }}</td>
                                    <td data-title="Qtde. Restante">{{ $ordem_item->quantidade_restante }}</td>

                                    <td>
                                      @if ($ordem_item->quantidade_restante > 0)
                                        @if ($ordem_item->quantidade_aceita == 0)
                                          <a title="Revisar quantidade" class="btn btn-primary" href="{{ route ("/ordemfornecimento/baixaItem", ['id' => $ordem_item->id])}}">
                                            <img src="/img/edit.png" height="21" width="17" align = "right">
                                          </a>
                                        @else
                                          <a title="Corrigir" class="btn btn-success" href="{{ route ("/ordemfornecimento/baixaItem", ['id' => $ordem_item->id])}}">
                                            <img src="/img/contra.png" height="21" width="17" align = "right">
                                          </a>
                                        @endif
                                      @endif
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
                      <a id="btnconcluir" class="btn btn-primary" href="{{ route ('/ordemfornecimento/baixaOrdem', ['id' => $ordem_item->ordem_fornecimento_id])}}">Concluir</a>
                      {{-- onClick="avisoBaixa({{$distribuicao->id}});" --}}
                      <a class="btn btn-primary" href="{{URL::previous()}}">Voltar</a>

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