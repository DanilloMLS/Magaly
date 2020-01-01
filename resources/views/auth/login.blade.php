<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<link rel="stylesheet" href="css/login.css">

@extends('layouts.app')

@section('content')
<div class="container h-100">
  <div class="d-flex justify-content-center h-100">
    <div class="user_card">
      <div class="d-flex justify-content-center">
        <div class="brand_logo_container">
          <img src="img/MG-S.png" class="brand_logo" alt="Logo">
        </div>
      </div>
      <div class="d-flex justify-content-center form_container">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>

            <input type="email" id="email" placeholder="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
          </div>
          <div class="input-group mb-2">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" id="password" value="" placeholder="senha" class="form-control{{ $errors->has('senha') ? ' is-invalid' : '' }}" name="password" value="{{ old('senha') }}" required autofocus>

                @if ($errors->has('senha'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="custom-control-label" for="remember">Lembrar</label>
            </div>
          </div>

      <div class="d-flex justify-content-center mt-3 login_container">
        <button type="submit" id="login" name="login" class="btn login_btn">{{ __('Login') }}</button>
      </div>
      <div class="d-flex justify-content-center mt-3 login_container">
        <a class="link" aling="center" href={{route ('password.request')}}>Esqueci minha senha</a>
      </div>
    </form>
    </div>
    </div>
  </div>
</div>
@endsection
