@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Distribuição') }}</div>
                {{-- Fora de circulação --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('/distribuicao/salvar') }}">
                      <input type="hidden" name="id" value="{{ $distribuicao->id}}" />
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="observacao" class="col-md-4 col-form-label text-md-right">{{ __('Observação ') }}</label>

                            <div class="col-md-6">
                              <input name="observacao" id="observacao" type="text" class="form-control{{ $errors->has('observacao') ? ' is-invalid' : '' }}" value="{{old('observacao', $distribuicao->observacao)}}">


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_escola" class="col-md-4 col-form-label text-md-right">{{ __('Escola') }}</label>
                            @if(count($escolas) != 0 and count($escolas) != 0)
                            <div class="col-md-6">
                              <select class="form-control" id="escolas" name="escola_id" >
      								              <option value="">Selecione uma Escola</option>
      								              @foreach($escolas as $escola)
      									            <option value="{{$escola->id}}" @if($escola != NULL && $escola->id == $distribuicao->escola_id) selected="selected" @endif>{{$escola->nome}}</option>
      								              @endforeach
                              </select>
                            </div>
                            @else
                            <div class="col-md-6">
                              <select class="form-control" id="escolas" name="escola_id" >
      								              <option value="">Não há escolas cadastradas</option>
                              </select>
                            </div>
                            @endif

                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Salvar
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
