<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('imgs/favico.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="../../css/login.css">
    <title>Mi Primera Borrachera</title>
</head>
<body>
    
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body row">
    
                    <div class="col-md-6 d-flex align-items-center justify-content-center"> 
                        <img src="{{ asset('imgs/image2.png') }}" alt="" class="img-fluid"> 
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}" class="col-md-6 d-flex flex-column">
                        @csrf
                        <h1>INICIAR SESIÓN</h1>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correo') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <a href="">¿Olvidaste tu contraseña?</a>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Recordar datos') }}
                                </label>
                            </div>
                            
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="btn btn-warning">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>


                    <div class="col-md-12 text-center mt-3">
                        <a href="{{ url('create/admin') }}" class="btn btn-primary">
                            Registrar Nuevo admin
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

</body>
</html>
