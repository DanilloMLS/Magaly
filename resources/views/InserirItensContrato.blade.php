@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Inserir Itens') }}</div>

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
                              Você ainda não cadastrou nenhum item.
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
                                <th>Gramatura</th>
                                <th>Valor</th>
                                <th>Quantidade</th>

                                  <th colspan="2">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($itens as $item)
                                <tr>
                                    <td data-title="Nome">{{ $item->nome }}</td>
                                    <td data-title="Data de Validade">{{ $item->data_validade }}</td>
                                    <td data-title="N lote">{{ $item->n_lote }}</td>
                                    <td data-title="Descricao">{{ $item->descricao }}</td>
                                    <td data-title="Gramatura">{{ $item->gramatura }}</td>
                                    <td data-title="Valor">
                                      <form method="POST" action="/lista/inserirAtividade">
                                        {{ csrf_field() }}
                                          @csrf
                                      <input type="hidden" name="contrato_id" value="{{ $contrato->id}}" />
                                      <input name="valor" id="valor" type="number"  class="form-control" required value= {{ old('valor')}}> {{ $errors->first('valor')}}
                                    </td>
                                    <td data-title="Quantidade">
                                      <input name="valor" id="quantidade" type="text"  class="form-control" required value= {{ old('quantidade')}}> {{ $errors->first('quantidade')}}
                                    </td>


                                    <td>

                                    <button class="btn btn-primary" type="submit">+</button>

                                    </form>

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
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
