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
                                      <th>Descrição</th>
                                      <th>Peso líquido</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($refeicoes as $refeicao)
                                    <tr>
                                        <td data-title="Nome">{{ $refeicao->nome }}</td>
                                        <td data-title="Descricao">{{ $refeicao->descricao }}</td>
                                        <td data-title="Peso_liquido">{{ $refeicao->peso_liquido }}</td>
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
