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
                                      <th>Modalidade de Ensino</th>
                                      <th>Rota</th>
                                      <th>Endereço</th>
                                      <th>Período de Atendimento</th>
                                      <th>Quantidade de Alunos</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($escolas as $escola)
                                    <tr>
                                        <td data-title="Nome">{{ $escola->nome }}</td>
                                        <td data-title="Modalidade de Ensino">{{ $escola->modalidade_ensino }}</td>
                                        <td data-title="Rota">{{ $escola->rota }}</td>
                                        <td data-title="Endereco">{{ $escola->endereco }}</td>
                                        <td data-title="Período de Atendimento">{{ $escola->periodo_atendimento }}</td>
                                        <td data-title="Quantidade de Alunos">{{ $escola->qtde_alunos }}</td>
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