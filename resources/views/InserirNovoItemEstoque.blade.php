@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inserir Item no Estoque') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/estoque/novoItem') }}">
                      {{ csrf_field() }}
                        @csrf

                        <input type="hidden" name="estoque_id" value="{{$estoque->id}}" />

                        <div class="form-group row">
                            <label for="item_id" class="col-md-4 col-form-label text-md-right">{{ __('Item') }}</label>
                            @if(count($itens) != 0 and count($itens) != 0)
                            <div class="col-md-6">
                              <select class="form-control" id="itens" name="item_id" required>
      								              <option value="">Selecione um Item</option>
      								              @foreach($itens as $item)
      									            <option value="{{$item->id}}">{{$item->nome}} - {{$item->gramatura}}{{$item->unidade}}</option>
      								              @endforeach
                              </select>
                            </div>
                            @else
                            <div class="col-md-6">
                              <select class="form-control" id="itens" name="item_id" required>
      								              <option value="">Não há itens cadastrados</option>
                              </select>
                            </div>
                            @endif
                         </div>

                        <div class="form-group row">
                            <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade" id="quantidade" type="number" pattern="^[-+]?[0-9]*" class="form-control" required value= {{ old('quantidade')}}> {{ $errors->first('quantidade')}}</input>

                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="quantidade_danificados" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade danificados') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade_danificados" id="quantidade_danificados" type="number" pattern="^[-+]?[0-9]*" class="form-control" required value= {{ old('quantidade_danificados')}}> {{ $errors->first('quantidade_danificados')}}</input>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Inserir no Estoque
                              </button>
                            <a class="btn btn-primary" href="/estoque/exibirItensEstoque/+{{$estoque->id}}">Finalizar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection