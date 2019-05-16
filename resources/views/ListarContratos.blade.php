@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contratos') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($contratos) == 0 and count($contratos) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum contrato cadastrado no sistema.
                      </div>
                      @else
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Valor Total</th>
                                  <th>Valor Restante</th>
                                  <th>Fornecedor</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($contratos as $contrato)
                                <tr>
                                    <td data-title="Valor Total">{{ $contrato->valor_total }}</td>
                                    <td data-title="Valor Restante">{{ $contrato->valor_restante }}</td>
                                    <?php $fornecedor = \App\Fornecedor::find($contrato->fornecedor_id)?>
                                    <td data-title="Fornecedor">{{ $fornecedor->nome }}</td>

                                    </td>


                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="{{URL::previous()}}">Voltar</a>

                      <a class="btn btn-primary" href="{{ route("/contrato/telaCadastrar") }}">Novo</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
