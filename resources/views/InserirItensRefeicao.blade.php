@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
                              <strong><div class="form-group row">
                                <div class="col-md-3">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-3">
                                  <center>Marca</center>
                                </div>
                                <div class="col-md-2">
                                  Gramatura
                                </div>
                                <div class="col-md-2">
                                  <center>Quantidade</center>
                                </div>
                                <div class="col-md-3">
                                  <center></center>
                                </div>
                              </div> </strong>
                              @foreach ($itens as $item)
                              <form method="POST" action="{{route ('/refeicao/inserirItem')}}">
                                {{ csrf_field() }}
                                  @csrf
                              <input type="hidden" name="refeicao_id" value="{{ $refeicao->id}}" />
                              <input type="hidden" name="item_id" value="{{ $item->id}}" />

                              <div class="form-group row">

                                  <div class="col-md-3">
                                    {{ $item->nome }}
                                  </div>
                                  <div class="col-md-3">
                                    {{ $item->marca }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ $item->gramatura }}
                                  </div>

                                  <div class="col-md-2">
                                    <input name="quantidade" id="quantidade" type="text" pattern="[0-9]*\.?[0-9]+$" class="form-control" value= {{ old('quantidade')}}> 
                                  </div>
                                  <div class="col-md-1" style="padding-top:10px">
                                    @if ($item->unidade == 'G')
                                      g
                                    @endif
                                    @if ($item->unidade == 'ML')
                                      ml
                                    @endif
                                  </div>


                                  <div class="col-md-1">
                                    <?php
                                        $refeicao_item = \App\Refeicao_item::where('refeicao_id', '=', $refeicao->id)
                                                                                ->where('item_id', '=', $item->id)
                                                                                ->first();
                                        if(empty($refeicao_item)){ ?>
                                          <button class="btn btn-success" type="submit">+</button>
                                      <?php } else { ?>
                                        <a class="btn btn-danger" href="{{ route ("/refeicao/removerItem", ['id' => $refeicao_item->id])}}">
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
                      <center><a class="btn btn-primary" href="/refeicao/finalizarRefeicao/{{$refeicao->id}}">Concluir</a></center>
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
