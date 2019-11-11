@extends('layouts.app')

@section('content')

<script language= 'javascript'>
    function avisoBaixa(id){
      if(confirm (' Deseja realmente dar baixa? ')) {
        location.href="/distribuicao/concluirBaixa/"+id;
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
                <div class="card-header">{{ __('Baixa Distribuição - Lista de Itens') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($distribuicao_itens) == 0)
                      <div class="alert alert-danger">
                              Não há itens nesta distribuição.
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
                                  <th title="Quantidade total pedida">Qtde. Pedida</th>
                                  <th>Qtde. Aceita</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($distribuicao_itens as $distribuicao_item)
                                <tr>
                                    @php
                                      $item = \App\Item::find($distribuicao_item->item_id);
                                    @endphp
                                    <td data-title="Nome">{{ $item->nome }}</td>
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}{{ $item->unidade }}</td>
                                    <td data-title="Qtde. Danificados">{{ $distribuicao_item->quantidade_danificados }}</td>
                                    <td data-title="Qtde. Falta">
                                      @if ($distribuicao_item->quantidade_falta >= 0)
                                        {{ $distribuicao_item->quantidade_falta }}
                                      @else
                                        {{ "excesso ".$distribuicao_item->quantidade_falta*(-1) }}
                                      @endif
                                    </td>
                                    <td data-title="Qtde. Pedida">{{ $distribuicao_item->quantidade_total }}</td>
                                    <td data-title="Qtde. Aceita">{{ $distribuicao_item->quantidade_aceita }}</td>

                                    <td>
                                      @if ($distribuicao_item->baixado == false)
                                        <a title="Revisar quantidade" class="btn btn-primary" href="{{ route ("/distribuicao/baixaItem", ['id' => $distribuicao_item->id])}}">
                                          <img src="/img/edit.png" height="21" width="17" align = "right">
                                        </a>
                                      @else
                                      <a title="Corrigir" class="btn btn-success" href="{{ route ("/distribuicao/baixaItem", ['id' => $distribuicao_item->id])}}">
                                        <img src="/img/contra.png" height="21" width="17" align = "right">
                                      </a>
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
                      <a class="btn btn-primary" onClick="avisoBaixa({{$distribuicao->id}});">Concluir</a>
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
