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
                                <thead>
                                  <tr>
                                      <th>Nome</th>
                                      <th>CNPJ</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($fornecedores as $fornecedor)
                                    <tr>
                                        <td data-title="Nome">{{ $fornecedor->nome }}</td>
                                        <td data-title="Descrição">{{ $fornecedor->cnpj }}</td>
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
</html>
