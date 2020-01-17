@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cardápios') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($cardapios) == 0 and count($cardapios) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum cardápio cadastrado no sistema.
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
                                  <th>Modalidade de Ensino</th>
                                  <th>Data de início</th>
                                  <th>Data de fim</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($cardapios as $cardapio)
                                <tr>
                                    <td data-title="Nome">{{ $cardapio->nome }}</td>
                                    <td data-title="Modalidade">{{ $cardapio->modalidade_ensino }}</td>
                                    <td data-title="Data_inicio">{{ $cardapio->data_inicio }}</td>
                                    <td data-title="Data_fim">{{ $cardapio->data_fim }}</td>

                                    <td align="right">
                                      <a title="Ver Refeições" class="btn btn-primary" href="{{ route ("/cardapio/exibirItensCardapio", ['id' => $cardapio->id])}}" >
                                        <img src="/img/menu.png" class="tamIconsPadrao">
                                      </a>
                                      <a title="Editar Cardapio" class="btn btn-primary" href="{{ route ("/cardapio/editarCardapioSemanal", ['id' => $cardapio->id])}}" >
                                        <img src="/img/edit.png" class="tamIconsPadrao">
                                      </a>
                                    </td>
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
