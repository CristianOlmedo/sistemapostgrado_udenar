@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php
    $login_url = route('coordinador.login');
    $register_url = route('coordinador.register');
    $password_reset_url = ''; // No es necesario para login
@endphp

@section('auth_header', __('Iniciar Sesión como Coordinador o Auxiliar'))

@section('auth_body')
    <form action="{{ $login_url }}" method="post">
        @csrf

        {{-- Correo electrónico --}}
        <div class="input-group mb-3">
            <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror"
                value="{{ old('correo') }}" placeholder="Correo electrónico" autofocus>

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

        {{-- Botón de iniciar sesión --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-sign-in-alt"></span> Iniciar Sesión
        </button>
    </form>
@stop

@section('auth_footer')
    {{-- Link a registro --}}
    <p class="my-0">
        <a href="{{ $register_url }}">
            No tengo una cuenta, registrar
        </a>
    </p>
@stop
