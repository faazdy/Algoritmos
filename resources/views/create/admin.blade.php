@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Administrador</h2>

    <form method="POST" action="{{ route('admin.register') }}">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" class="form-control" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input id="apellido" type="text" class="form-control" name="apellido" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input id="telefono" type="text" class="form-control" name="telefono" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Cajero</button>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </form>
</div>
@endsection
