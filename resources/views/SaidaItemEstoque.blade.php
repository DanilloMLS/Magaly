@extends('layouts.app')

@section('content')

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Saída de Item no Estoque') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/estoque/abrirSaida') }}">
                        <input type="hidden" name="id" value="{{ $estoque_item->id}}" />
                        {{ csrf_field() }}
                        @csrf

                        <input type="hidden" name="estoque_id" value="{{$estoque_item->estoque_id}}" />
                        <input type="hidden" name="item_id" value="{{$estoque_item->item_id}}" />
                        
                        <div class="form-group row">
                            <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade ') }}</label>
                            

                            <div class="col-md-6">
                              <input name="quantidade" id="quantidade" type="text" class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}" value="{{old('quantidade')}}"></input>
                                @if ($errors->has('quantidade'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantidade') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="quantidade_danificados" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade danificados') }}</label>

                            <div class="col-md-6">
                              <input name="quantidade_danificados" id="quantidade_danificados" type="text" class="form-control{{ $errors->has('quantidade_danificados') ? ' is-invalid' : '' }}" value="{{old('quantidade_danificados')}}"></input>
                                @if ($errors->has('quantidade_danificados'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantidade_danificados') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Fechar Saída
                              </button>
                            <a class="btn btn-primary" href="/estoque/exibirItensEstoque/+{{$estoque_item->estoque_id}}">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection