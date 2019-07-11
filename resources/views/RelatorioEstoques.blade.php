<html>
    <head></head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                          <div class="panel-body">
                            <div id="tabela" class="table-responsive">
                              <table class="table table-hover">
                                <tbody>
                                    @foreach ($estoques as $estoque)
                                        <tr>
                                            <td data-title="Nome"><font size="5"><b>{{ $estoque->nome }}</b></font></td>
                                        </tr>
                                        <tr>
                                            <th>Item</th>
                                            <th>Data de validade</th>
                                            <th>Nº lote</th>
                                            <th>Unidade</th>
                                            <th>Gramatura</th>
                                            <th>Descrição</th>
                                        </tr>
                                      @foreach (\App\Estoque_item::where('estoque_id', '=', $estoque->id)->get() as $item_estoque)
                                          @php
                                              $item = \App\Item::find($item_estoque->item_id);
                                          @endphp
                                          <tr>
                                              <td data-title="Valor unitário">{{ $item->nome }}</td>
                                              <td data-title="Data de validade">{{ $item->data_validade }}</td>
                                              <td data-title="Nº lote">{{ $item->n_lote }}</td>
                                              <td data-title="Unidade">{{ $item->unidade }}</td>
                                              <td data-title="Gramatura">{{ $item->gramatura }}</td>
                                              <td data-title="Descrição">{{ $item->descricao }}</td>
                                          </tr>
                                      @endforeach
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>