@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php
    $login_url = route('coordinador.login');
    $register_url = route('coordinador.register');
@endphp

@section('auth_header', __('Registro de Coordinador'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Nombre --}}
        <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                   value="{{ old('nombre') }}" placeholder="Nombre completo" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Identificación --}}
        <div class="input-group mb-3">
            <input type="text" name="identificacion" class="form-control @error('identificacion') is-invalid @enderror"
                   value="{{ old('identificacion') }}" placeholder="Identificación">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('identificacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Programa Académico --}}
        <div class="form-group">
            <label for="programa_academico">Programa Académico</label>
            <select name="programa_academico" id="programa_academico" class="form-control">
                @foreach($programasAcademicos as $programa)
                    <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Dirección --}}
        <div class="input-group mb-3">
            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                   value="{{ old('direccion') }}" placeholder="Dirección">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-home {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Teléfono --}}
        <div class="input-group mb-3">
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                   value="{{ old('telefono') }}" placeholder="Teléfono">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Correo electrónico --}}
        <div class="input-group mb-3">
            <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror"
                   value="{{ old('correo') }}" placeholder="Correo electrónico">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('correo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Género --}}
        <div class="form-group">
            <label for="genero">Género</label>
            <select name="genero" id="genero" class="form-control">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
            </select>
        </div>

        {{-- Fecha de nacimiento --}}
        <div class="input-group mb-3">
            <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                   value="{{ old('fecha_nacimiento') }}" placeholder="Fecha de nacimiento">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('fecha_nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Fecha de vinculación --}}
        <div class="input-group mb-3">
            <input type="date" name="fecha_vinculacion" class="form-control @error('fecha_vinculacion') is-invalid @enderror"
                   value="{{ old('fecha_vinculacion') }}" placeholder="Fecha de vinculación">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar-day {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('fecha_vinculacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Acuerdo de vinculación --}}
        <div class="input-group mb-3">
            <input type="file" name="acuerdo_vinculacion" class="form-control @error('acuerdo_vinculacion') is-invalid @enderror">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-file-pdf {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('acuerdo_vinculacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Contraseña --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Contraseña">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="Confirmar contraseña">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Botón de registro --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span> Registrar
        </button>
    </form>
@stop

@section('auth_footer')
    {{-- Link a inicio de sesión --}}
    <p class="my-0">
        <a href="{{ $login_url }}">
            Ya tengo una cuenta, iniciar sesión
        </a>
    </p>
@stop
