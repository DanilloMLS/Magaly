@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Itens desta refeição') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($itens) == 0 and count($itens) == 0)
                      <div class="alert alert-danger">
                              Não há nenhum item nesta refeição.
                      </div>
                      @else
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
                                  <th>Quantidade</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($itens as $item_refeicao)
                                <tr>
                                    @php
                                      $item = \App\Item::find($item_refeicao->item_id);
                                    @endphp
                                    <td data-title="Valor unitário">{{ $item->nome }}</td>
                                    <td data-title="Data de validade">{{ $item->data_validade }}</td>
                                    <td data-title="Nº lote">{{ $item->n_lote }}</td>
                                    <td data-title="Descrição">{{ $item->descricao }}</td>
                                    <td data-title="Unidade">{{ $item->unidade }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}</td>
                                    <td data-title="Quantidade">{{ $item_refeicao->quantidade }}</td>

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

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
