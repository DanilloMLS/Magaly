<html>
    <head></head>
    <body>
        <div id="tabela" class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Fornecedor</th>
                    <th>Nº Contrato</th>
                    <th>Nº Processo</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Valor Total</th>
                    <th>Itens</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contratos as $contrato)
                    <tr>
                        <?php $fornecedor = \App\Fornecedor::find($contrato->fornecedor_id)?>
                        <td data-title="Fornecedor">{{ $fornecedor->nome }}</td>
                        <td data-title="N_contrato">{{ $contrato->n_contrato }}</td>
                        <td data-title="N_processo">{{ $contrato->n_processo_licitatorio }}</td>
                        <td data-title="Descricao">{{ $contrato->descricao }}</td>
                        <td data-title="Data">{{ $contrato->data }}</td>
                        <td data-title="valor_total">{{ $contrato->valor_total }}</td>
                    </tr>
                    <tr>
                        <th>Nome</th>
                        <th>Data de validade</th>
                        <th>Nº lote</th>
                        <th>Descrição</th>
                        <th>Unidade</th>
                        <th>Gramatura</th>
                        <th>Quantidade</th>
                        <th>Valor unitário</th>
                    </tr>
                    @foreach (\App\Contrato_item::where('contrato_id', '=', $contrato->id)->get() as $item_contrato)
                        <tr>
                            @php
                                $item = \App\Item::find($item_contrato->item_id);
                            @endphp
                            <td data-title="Valor unitário">{{ $item->nome }}</td>
                            <td data-title="Data de validade">{{ $item->data_validade }}</td>
                            <td data-title="Nº lote">{{ $item->n_lote }}</td>
                            <td data-title="Descrição">{{ $item->descricao }}</td>
                            <td data-title="Unidade">{{ $item->unidade }}</td>
                            <td data-title="Gramatura">{{ $item->gramatura }}</td>
                            <td data-title="Quantidade">{{ $item_contrato->quantidade }}</td>
                            <td data-title="ValorUnitario">{{ $item_contrato->valor_unitario }}</td>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
