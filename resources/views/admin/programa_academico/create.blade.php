@extends('adminlte::page')

@section('title', 'Crear Programa Académico')

@section('content_header')
    <h1>Crear Programa Académico</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Mostrar mensajes de error y éxito -->
            @if (session('swal:success'))
                <div class="alert alert-success">
                    {{ session('swal:success') }}
                </div>
            @endif
            @if (session('swal:error'))
                <div class="alert alert-danger">
                    {{ session('swal:error') }}
                </div>
            @endif

            <!-- Formulario para crear un nuevo programa académico -->
            <form action="{{ route('programa_academico.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Código SNIES -->
                <div class="form-group">
                    <label for="codigo_snies">Código SNIES</label>
                    <input type="text" id="codigo_snies" name="codigo_snies"
                        class="form-control @error('codigo_snies') is-invalid @enderror" value="{{ old('codigo_snies') }}"
                        required>
                    @error('codigo_snies')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nombre del Programa -->
                <div class="form-group">
                    <label for="nombre_programa">Nombre del Programa</label>
                    <input type="text" id="nombre_programa" name="nombre_programa"
                        class="form-control @error('nombre_programa') is-invalid @enderror"
                        value="{{ old('nombre_programa') }}" required>
                    @error('nombre_programa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                        rows="4" required>{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Logo -->
                <div class="form-group">
                    <label for="logo">Logo (opcional)</label>
                    <input type="file" id="logo" name="logo"
                        class="form-control-file @error('logo') is-invalid @enderror">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo"
                        class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required>
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fecha de Resolución -->
                <div class="form-group">
                    <label for="fecha_resolucion">Fecha de Resolución</label>
                    <input type="date" id="fecha_resolucion" name="fecha_resolucion"
                        class="form-control @error('fecha_resolucion') is-invalid @enderror"
                        value="{{ old('fecha_resolucion') }}" required>
                    @error('fecha_resolucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Número de Resolución -->
                <div class="form-group">
                    <label for="numero_resolucion">Número de Resolución</label>
                    <input type="text" id="numero_resolucion" name="numero_resolucion"
                        class="form-control @error('numero_resolucion') is-invalid @enderror"
                        value="{{ old('numero_resolucion') }}" required>
                    @error('numero_resolucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Archivo de Resolución -->
                <div class="form-group">
                    <label for="archivo_resolucion">Archivo de Resolución (opcional)</label>
                    <input type="file" id="archivo_resolucion" name="archivo_resolucion"
                        class="form-control-file @error('archivo_resolucion') is-invalid @enderror">
                    @error('archivo_resolucion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botones de Acción -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('programa_academico.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop
