@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Senha') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/pessoa/changepass') }}">
                      {{ csrf_field() }}
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}" />
                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Digite a senha antiga') }}</label>

                            <div class="col-md-6">
                              <input name="old_password" id="old_password" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}">
                                @if ($errors->has('old_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Digite a nova Senha') }}</label>

                            <div class="col-md-6">
                              <input name="new_password" id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}">
                                @if ($errors->has('new_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_new_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirme a nova Senha') }}</label>

                            <div class="col-md-6">
                              <input name="confirm_new_password" id="confirm_new_password" type="password" class="form-control{{ $errors->has('confirm_new_password') ? ' is-invalid' : '' }}">
                                @if ($errors->has('confirm_new_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('confirm_new_password') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Alterar
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
