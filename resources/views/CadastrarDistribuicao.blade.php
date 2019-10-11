@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Distribuição') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/distribuicao/cadastrar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="observacao" class="col-md-4 col-form-label text-md-right">{{ __('Observação ') }}</label>

                            <div class="col-md-6">
                              <textarea name="observacao" id="observacao" type="text" class="form-control" value= {{ old('observacao')}}> {{ $errors->first('observacao')}}</textarea>


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_escola" class="col-md-4 col-form-label text-md-right">{{ __('Escola') }}</label>
                            @if(count($escolas) != 0 and count($escolas) != 0)
                            <div class="col-md-6">
                              <select class="form-control" id="escolas" name="escola_id">
      								              <option value="">Selecione uma Escola</option>
      								              @foreach($escolas as $escola)
      									            <option value="{{$escola->id}}">{{$escola->nome}}</option>
      								              @endforeach
                              </select>
                            </div>
                            @else
                            <div class="col-md-6">
                              <select class="form-control" id="escolas" name="escola_id">
      								              <option value="">Não há escolas cadastradas</option>
                              </select>
                            </div>
                            @endif
                         </div>

                         <div class="form-group row">
                             <label for="id_cardapio" class="col-md-4 col-form-label text-md-right">{{ __('Cardápio') }}</label>
                             @if(count($cardapios) != 0 and count($cardapios) != 0)
                             <div class="col-md-6">
                               <select class="form-control" id="cardapios" name="cardapio_id">
       								              <option value="">Selecione um Cardápio</option>
       								              @foreach($cardapios as $cardapio)
       									            <option value="{{$cardapio->id}}">{{$cardapio->nome}}</option>
       								              @endforeach
                               </select>
                             </div>
                             @else
                             <div class="col-md-6">
                               <select class="form-control" id="escolas" name="escola_id">
       								              <option value="">Não há cardápios cadastrados</option>
                               </select>
                             </div>
                             @endif
                          </div>

                          <div class="form-group row">
                            <label for="id_estoque" class="col-md-4 col-form-label text-md-right">{{ __('Estoque') }}</label>
                            @if(count($estoques) != 0 and count($estoques) != 0)
                            <div class="col-md-6">
                              <select class="form-control" id="estoques" name="estoque_id">
                                    <option value="">Selecione um Estoque</option>
                                    @foreach($estoques as $estoque)
                                    <option value="{{$estoque->id}}">{{$estoque->nome}}</option>
                                    @endforeach
                              </select>
                            </div>
                            @else
                            <div class="col-md-6">
                              <select class="form-control" id="estoques" name="estoque_id">
                                    <option value="">Não há estoques cadastrados</option>
                              </select>
                            </div>
                            @endif
                         </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Cadastrar
                              </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
