@extends('adminlte::page')

@section('title', 'Editar Docente')

@section('content_header')
    <h1>Editar Docente</h1>
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
            <form action="{{ route('docente.update', $docente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $docente->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="identificacion">identificación</label>
                    <input type="text" name="identificacion" class="form-control" value="{{ old('identificacion', $docente->identificacion) }}" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $docente->direccion) }}" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $docente->telefono) }}" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" class="form-control" value="{{ old('correo', $docente->correo) }}" required>
                </div>

                <div class="form-group">
                    <label for="genero">Genero</label>
                    <select name="genero" id="genero" class="form-control" required>
                        <option value="{{ old('genero', $docente->genero) }}">Seleccionar</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Ncimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $docente->fecha_nacimiento) }}" required>
                </div>

                <div class="form-group">
                    <label for="formacion_academica">Formación Academica</label>
                    <select name="formacion_academica" id="formacion_academica" class="form-control" required>
                        <option value="{{ old('formacion_academica', $docente->formacion_academica) }}">Seleccionar</option>
                        <option value="Pregrado">Pregrado</option>
                        <option value="Postgrado">Postgrado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="area_conocimiento">Area de conocimiento</label>
                    <select name="area_conocimiento" id="area_conocimiento" class="form-control" required>
                        <option value="{{ old('area_conocimiento', $docente->area_conocimiento) }}">Seleccionar</option>
                        <option value="Ingenieria de Software">Ingeniería de Software</option>
                        <option value="Telecomunicaciones">Telecomunicaciones</option>
                        <option value="Bases de datos">Bases de datos</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('programa_academico.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
