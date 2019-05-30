@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm (' Deseja realmente excluir este fornecedor? ')) {
    location.href="/fornecedor/remover/"+id;
  }
  else {
    return false;
  }
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Fornecedores') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($fornecedores) == 0 and count($fornecedores) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum fornecedor cadastrado no sistema.
                      </div>
                      @else
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>CNPJ</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($fornecedores as $fornecedor)
                                <tr>
                                    <td data-title="Nome">{{ $fornecedor->nome }}</td>
                                    <td data-title="Descrição">{{ $fornecedor->cnpj }}</td>
                                    
                                    <td>
                                      <a class="btn btn-primary" href="/fornecedor/editar/{{$fornecedor->id}}">Editar</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar({{$fornecedor->id}});"> Excluir</a>
                                    </td>
                                    <td></td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="{{URL::previous()}}">Voltar</a>

                      <a class="btn btn-primary" href="{{ route("/fornecedor/cadastrar") }}">Novo</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
