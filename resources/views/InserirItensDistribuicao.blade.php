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
                              Você ainda não cadastrou nenhum item.
                      </div>
                      @else
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                              <div class="form-group row">
                                <div class="col-md-2">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-2">
                                  Gramatura
                                </div>
                                <div class="col-md-2">
                                  <center>N° lote</center>
                                </div>
                                <div class="col-md-2">
                                  <center>Falta</center>
                                </div>
                                <div class="col-md-2">
                                  <center>Danificados</center>
                                </div>
                                <div class="col-md-2">
                                  <center>Total</center>
                                </div>
                              </div>
                              @foreach ($itens as $item)
                              <form method="POST" action="/distribuicao/inserirItem">
                                {{ csrf_field() }}
                                  @csrf
                              <input type="hidden" name="distribuicao_id" value="{{ $distribuicao->id}}" />
                              <input type="hidden" name="item_id" value="{{ $item->id}}" />

                              <div class="form-group row">

                                  <div class="col-md-2">
                                    {{ $item->nome }}
                                  </div>
                                  <div class="col-md-1">
                                    {{ $item->gramatura }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ $item->n_lote }}
                                  </div>

                                  <div class="col-md-2">
                                    <input name="quantidade_falta" id="quantidade_falta" type="number"  class="form-control" value= {{ old('quantidade_falta')}}> {{ $errors->first('quantidade_falta')}}
                                  </div>
                                  <div class="col-md-2">
                                    <input name="quantidade_danificados" id="quantidade_danificados" type="number"  class="form-control" value= {{ old('quantidade_danificado')}}> {{ $errors->first('quantidade_danificados')}}
                                  </div>
                                  <div class="col-md-2">
                                    <input name="quantidade" id="quantidade" type="number"  class="form-control" required value= {{ old('quantidade')}}> {{ $errors->first('quantidade')}}
                                  </div>
                                  <div class="col-md-1">
                                    <?php
                                        $distribuicao_item = \App\Distribuicao_item::where('distribuicao_id', '=', $distribuicao->id)
                                                                                ->where('item_id', '=', $item->id)
                                                                                ->first();
                                        if(empty($distribuicao_item)){ ?>
                                          <button class="btn btn-success" type="submit">+</button>
                                      <?php } else { ?>
                                        <a class="btn btn-danger" href="/distribuicao/removerItem/{{$distribuicao_item->id}}">
                                        -
                                        </a>
                                    <?php } ?>

                                  </div>
                              </div>

                            </form>


                              @endforeach

                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <center><a class="btn btn-primary" href="/distribuicao/finalizarDistribuicao/{{$distribuicao->id}}">Concluir</a></center>
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
