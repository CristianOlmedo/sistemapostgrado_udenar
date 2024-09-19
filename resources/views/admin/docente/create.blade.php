@extends('adminlte::page')

@section('title', 'Crear Docente')

@section('content_header')
    <h1>Crear Nuevo Docente</h1>
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
            <form action="{{ route('docente.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="identificacion">Identificacion</label>
                    <input type="text" name="identificacion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="direccion">direccion</label>
                    <input type="text" name="direccion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="genero">Genero</label>
                    <select name="genero" id="genero" class="form-control" required>
                        <option value="">Seleccionar</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
                </div>

                <div class="form-group">
                    <label for="formacion_academica">Formación Academica</label>
                    <select name="formacion_academica" id="formacion_academica" class="form-control" required>
                        <option value="">Seleccionar</option>
                        <option value="Pregrado">Pregrado</option>
                        <option value="Postgrado">Postgrado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="area_conocimiento">Area de conocimiento</label>
                    <select name="area_conocimiento" id="area_conocimiento" class="form-control" required>
                        <option value="">Seleccionar</option>
                        <option value="Ingenieria de Software">Ingeniería de Software</option>
                        <option value="Telecomunicaciones">Telecomunicaciones</option>
                        <option value="Bases de datos">Bases de datos</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('cohorte.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
