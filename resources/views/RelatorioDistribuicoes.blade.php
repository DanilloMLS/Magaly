<html>
    <head>

    </head>
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
                                        @foreach ($distribuicoes as $distribuicao)
                                            <tr>
                                                <th>Escola</th>
                                                <th>Observação</th>
                                            </tr>
                                            <tr>
                                                <?php $escola = \App\Escola::find($distribuicao->escola_id)?>
                                                <td data-title="Modalidade de Ensino">{{ $escola->nome }}</td>
                                                <td data-title="Observação">{{ $distribuicao->observacao }}</td>
                                            </tr>
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantidade</th>
                                                <th>Data de validade</th>
                                                <th>Qtd. danificados</th>
                                                <th>Qtd. falta</th>
                                            </tr>
                                            @foreach (\App\Distribuicao_item::where('distribuicao_id', '=', $distribuicao->id)->get() as $item_distribuicao)
                                                <tr>
                                                    @php
                                                        $item = \App\Item::find($item_distribuicao->item_id);
                                                    @endphp
                                                    <td data-title="Valor unitário">{{ $item->nome }}</td>
                                                    <td data-title="Quantidade">{{ $item_distribuicao->quantidade }}</td>
                                                    <td data-title="Data de validade">{{ $item->data_validade }}</td>
                                                    <td data-title="QuantidadeDanificados">{{ $item_distribuicao->quantidade_danificados}}</td>
                                                    <td data-title="QuantidadeFalta">{{ $item_distribuicao->quantidade_falta }}</td>

                                                    </td>


                                                    <td></td>
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