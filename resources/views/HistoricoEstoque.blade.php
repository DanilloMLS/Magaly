@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Histórico de movimentação deste estoque') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                      @if(count($itens_historico) == 0 and count($itens_historico) == 0)
                      <div class="alert alert-danger">
                              Não há movimentações de itens neste estoque.
                      </div>
                      @else
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>Operação</th>
                                  <th>Item</th>
                                  <th>Quantidade</th>
                                  <th>Quantidade danificados</th>
                                  <th>Data e hora</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($itens_historico as $item_historico)
                                <tr>
                                    @php
                                      $item = \App\Item::find($item_historico->item_id);
                                    @endphp
                                    <td data-title="Operação">{{ $item_historico->operacao }}</td>
                                    <td data-title="Item">{{ $item->nome }}</td>
                                    <td data-title="Quantidade">{{ $item_historico->quantidade }}</td>
                                    <td data-title="Quantidade danificados">{{ $item_historico->quantidade_danificados}}</td>
                                    <td data-title="Data e hora">{{ $item_historico->created_at }}</td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      @endif
                  </div>
                  <div class="panel-footer">
                      <a class="btn btn-primary" href="{{route ('/estoque/listar')}}">Voltar</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
