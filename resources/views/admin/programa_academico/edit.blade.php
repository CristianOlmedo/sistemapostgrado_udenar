@extends('adminlte::page')

@section('title', 'Editar Programa Académico')

@section('content_header')
    <h1>Editar Programa Académico</h1>
@stop

@section('content')
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
        <div class="card-body">
            <form action="{{ route('programa_academico.update', $programaAcademico->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="codigo_snies">Código SNIES</label>
                    <input type="text" name="codigo_snies" class="form-control" value="{{ old('codigo_snies', $programaAcademico->codigo_snies) }}" required>
                </div>

                <div class="form-group">
                    <label for="nombre_programa">Nombre del Programa</label>
                    <input type="text" name="nombre_programa" class="form-control" value="{{ old('nombre_programa', $programaAcademico->nombre_programa) }}" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $programaAcademico->descripcion) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control" value="{{ old('correo', $programaAcademico->correo) }}" required>
                </div>

                <div class="form-group">
                    <label for="logo">Logo del Programa (opcional)</label>
                    <input type="file" name="logo" class="form-control-file" accept="image/*">
                    @if ($programaAcademico->logo)
                        <p><img src="{{ Storage::url($programaAcademico->logo) }}" alt="Logo del Programa" width="150"></p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="fecha_resolucion">Fecha de Resolución de Registro Calificado</label>
                    <input type="date" name="fecha_resolucion" class="form-control" value="{{ old('fecha_resolucion', $programaAcademico->fecha_resolucion) }}" required>
                </div>

                <div class="form-group">
                    <label for="numero_resolucion">Número de Resolución de Registro Calificado</label>
                    <input type="text" name="numero_resolucion" class="form-control" value="{{ old('numero_resolucion', $programaAcademico->numero_resolucion) }}" required>
                </div>

                <div class="form-group">
                    <label for="archivo_resolucion">Archivo de Resolución (opcional)</label>
                    <input type="file" name="archivo_resolucion" class="form-control-file" accept=".pdf">
                    @if ($programaAcademico->archivo_resolucion)
                        <p><a href="{{ Storage::url($programaAcademico->archivo_resolucion) }}" target="_blank">Ver Resolución Actual</a></p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('programa_academico.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
