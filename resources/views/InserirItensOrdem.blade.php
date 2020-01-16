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
                <div class="card-header">{{ __('Inserir Itens na Ordem de Fornecimento') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($contratos) == 0)
                      <div class="alert alert-danger">
                              O fornecedor não possui contratos.
                      </div>
                      @else
                      <div id= "termoBusca" style="display: flex; justify-content: flex-end">
                      <input type="text" id="termo" onkeyup="buscar()" placeholder="Busca">
                      </div>
                              <strong><div class="form-group row">
                                <div class="col-md-2">
                                  <center>Nome</center>
                                </div>
                                <div class="col-md-2">
                                  <center>Marca</center>
                                </div>
                                <div class="col-md-2">
                                  Gramatura
                                </div>
                                <div class="col-md-2">
                                  Nº Contrato  
                                </div>
                                <div class="col-md-2">
                                  <center>Quantidade</center>
                                </div>
                                {{-- <div class="col-md-2">
                                  <center>Quantidade Danif.</center>
                                </div> --}}
                                <div class="col-md-3">
                                  <center></center>
                                </div>
                              </div> </strong>
                              @foreach ($contratos as $contrato_item)
                              <form method="POST" action="{{route ('/ordemfornecimento/inserirItem')}}">
                                {{ csrf_field() }}
                                  @csrf
                              {{-- @php
                                  $contrato_item = \App\Contrato_item::where('contrato_id', '=', $contrato->id)->get();
                              @endphp --}}

                              <input type="hidden" name="ordem_fornecimento_id" value="{{ $id }}" />
                              <input type="hidden" name="contratoitem_id" value="{{ $contrato_item->id }}" />

                              <div class="form-group row">
                                
                                @php
                                    $item = \App\Item::find($contrato_item->item_id);
                                    $contrato = \App\Contrato::find($contrato_item->contrato_id);
                                @endphp

                                  <div class="col-md-2">
                                    {{ $item->nome }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ $item->marca }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ $item->gramatura }}
                                    @if ($item->unidade == 'G')
                                      g
                                    @endif
                                    @if ($item->unidade == 'ML')
                                      ml
                                    @endif
                                  </div>
                                  <div class="col-md-2">
                                    {{ $contrato->n_contrato }}
                                  </div>

                                  <div class="col-md-2">
                                    <input name="quantidade" id="quantidade" type="text" class="form-control" value=""> 
                                  </div>
                                  {{-- <div class="col-md-2">
                                    <input name="quantidade_danificados" id="quantidade_danificados" type="text" class="form-control" value= {{ old('quantidade_danificados')}}> 
                                  </div> --}}

                                  <div class="col-md-1">
                                    <?php
                                        $ordem_item = \App\Ordem_item::where('ordem_fornecimento_id', '=', $id)
                                                                                ->where('contratoitem_id', '=', $contrato_item->id)

                                                                                ->first();
                                        if(empty($ordem_item)){ ?>
                                          <button class="btn btn-success" type="submit">+</button>
                                      <?php } else { ?>
                                        <a class="btn btn-danger" href="{{ route ("/ordemfornecimento/removerItem", ['id' => $ordem_item->id])}}">
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
                      <center><a class="btn btn-primary" href="/ordemfornecimento/listar">Concluir</a></center>
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