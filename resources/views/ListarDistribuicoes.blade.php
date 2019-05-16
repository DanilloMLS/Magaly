@extends('layouts.app')

@section('content')

<script language= 'javascript'>
function avisoDeletar(id){
  if(confirm (' Deseja realmente excluir esta distribuição? ')) {
    location.href="/distribuicao/remover/"+id;
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
                <div class="card-header">{{ __('Distribuições') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($distribuicoes) == 0 and count($distribuicoes) == 0)
                      <div class="alert alert-danger">
                              Não há nenhuma distribuição cadastrada no sistema.
                      </div>
                      @else
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Observação</th>
                                  <th>Escola</th>
                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($distribuicoes as $distribuicao)
                                <tr>
                                    <td data-title="Observação">{{ $distribuicao->observacao }}</td>
                                    <td data-title="Modalidade de Ensino">{{ $distribuicao->escola_id }}</td>

                                    </td>

                                    <td>
                                      <a class="btn btn-primary" href="/distribuicao/editar/{{$distribuicao->id}}">Editar</a>
                                    </td>
                                    <td>
                                      <a class="btn btn-primary" onClick="avisoDeletar({{$distribuicao->id}});"> Excluir</a>
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

                      <a class="btn btn-primary" href="{{ route("/distribuicao/telaCadastrar") }}">Nova</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
