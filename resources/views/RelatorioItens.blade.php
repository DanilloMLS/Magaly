<htm>
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
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Data de validade</th>
                                            <th>Nº lote</th>
                                            <th>Descrição</th>
                                            <th>Unidade</th>
                                            <th>Gramatura</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($itens as $item)
                                            <tr>
                                                <td data-title="Valor unitário">{{ $item->nome }}</td>
                                                <td data-title="Data de validade">{{ $item->data_validade }}</td>
                                                <td data-title="Nº lote">{{ $item->n_lote }}</td>
                                                <td data-title="Descrição">{{ $item->descricao }}</td>
                                                <td data-title="Unidade">{{ $item->unidade }}</td>
                                                <td data-title="Gramatura">{{ $item->gramatura }}</td>
                                            </tr>
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
</htm>