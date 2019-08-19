@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Inserir Itens') }}</div>

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
                              Você ainda não cadastrou nenhum item neste cardápio.
                      </div>
                      @else
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                              <strong><div class="form-group row">
                                <div class="col-md-3">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-3">
                                  Descrição
                                </div>
                                <div class="col-md-2">
                                  <center>Quantidade Total</center>
                                </div>
                              </div></strong>
                              @foreach ($itens as $item)

                              <div class="form-group row">

                                  <div class="col-md-3">
                                    @php
                                    $item_nome = \App\Item::find($item->item_id);
                                    @endphp
                                    {{ $item_nome->nome }}
                                  </div>

                                  <div class="col-md-3">
                                    @php
                                    $item_descricao = \App\Item::find($item->item_id);
                                    @endphp
                                    {{ $item_descricao->descricao }}
                                  </div>

                                  <div class="col-md-2">
                                    {{ $item->quantidade_total }}
                                  </div>

                              </div>

                              @endforeach

                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <center><a class="btn btn-primary" href="{{ route ('/distribuicao/listar')}}">Confirmar</a></center>
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
