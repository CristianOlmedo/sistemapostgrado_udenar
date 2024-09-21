@extends('adminlte::page')

@section('title', 'Crear Presidente')

@section('content_header')
    <h1>Crear Presidente</h1>
@stop

@section('content')
    <form action="{{ route('presidente.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre_completo">Nombre completo</label>
            <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="correo_electronico">Correo electrónico</label>
            <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="numero_identificacion">Número de identificación</label>
            <input type="text" name="numero_identificacion" id="numero_identificacion" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control">
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
        </div>

        <div class="form-group">
            <label for="fecha_inicio_gestion">Fecha de inicio de gestión</label>
            <input type="date" name="fecha_inicio_gestion" id="fecha_inicio_gestion" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin_gestion">Fecha de fin de gestión</label>
            <input type="date" name="fecha_fin_gestion" id="fecha_fin_gestion" class="form-control">
        </div>

        <div class="form-group">
            <label for="departamento_o_facultad">Departamento o Facultad</label>
            <input type="text" name="departamento_o_facultad" id="departamento_o_facultad" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="programa_academico">Programa:</label>
            <input type="text" name="programa_academico" id="programa_academico" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="resoluciones">Resoluciones o nombramientos</label>
            <input type="file" name="resoluciones" id="resoluciones" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@stop
