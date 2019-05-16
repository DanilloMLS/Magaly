@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm (' Deseja realmente excluir esta escola? ')) {
    location.href="/escola/remover/"+id;
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
                <div class="card-header">{{ __('Escolas') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($escolas) == 0 and count($escolas) == 0)
                      <div class="alert alert-danger">
                              Não há nenhuma escola cadastrada no sistema.
                      </div>
                      @else
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Modalidade de Ensino</th>
                                  <th>Rota</th>
                                  <th>Endereco</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($escolas as $escola)
                                <tr>
                                    <td data-title="Nome">{{ $escola->nome }}</td>
                                    <td data-title="Modalidade de Ensino">{{ $escola->modalidade_ensino }}</td>
                                    <td data-title="Rota">{{ $escola->rota }}</td>
                                    <td data-title="Endereco">Rua: {{ $escola->endereco->rua }}<br>
                                                              Bairro: {{ $escola->endereco->bairro }}<br>
                                                              CEP: {{ $escola->endereco->cep }}<br>
                                                              Número: {{ $escola->endereco->numero }}<br>
                                    </td>

                                    <td>
                                      <a class="btn btn-primary" href="/escola/editar/{{$escola->id}}">Editar</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar({{$escola->id}});"> Excluir</a>
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

                      <a class="btn btn-primary" href="{{ route("/escola/cadastrar") }}">Nova</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
