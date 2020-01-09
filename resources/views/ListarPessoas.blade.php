@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pessoas') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                    </div>
                  @endif
                  @if (\Session::has('warning'))
                    <div class="alert alert-warning" role="alert">
                        {!! \Session::get('warning') !!}
                    </div>
                  @endif
                  <div class="panel-body">

                    <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">                      
                    </div>
                      @if(count($pessoas) == 0 and count($pessoas) == 0)
                      <div class="alert alert-danger">
                              Não há nenhuma pessoa cadastrada no sistema.
                      </div>
                      @else
                          <br>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>CPF</th>
                                  <th>Telefone</th>
                                  <th>Sexo</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($pessoas as $pessoa)
                                <tr>
                                    <td data-title="Nome">{{ $pessoa->nome }}</td>
                                    <td data-title="CPF">{{ $pessoa->cpf }}</td>
                                    <td data-title="Telefone">{{ $pessoa->telefone }}</td>
                                    <td data-title="Sexo">{{ $pessoa->sexo }}</td>

                                    @if (Auth::guard()->check() && Auth::user()->is_adm)
                                      <td align="right">
                                        <a class="btn btn-primary" title="Editar pessoa" href="{{ route ("/pessoa/editar", ['id' => $pessoa->id])}}">
                                          <img src="/img/edit.png" class="tamIconsPadrao">
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
