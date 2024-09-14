@extends('adminlte::page')

@section('title', 'Crear Coordinador')

@section('content_header')
    <h1>Crear Coordinador</h1>
@stop

@section('content')
    <form action="{{ route('coordinador.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="identificacion">Identificación</label>
            <input type="text" name="identificacion" id="identificacion" class="form-control" required>
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
            <label for="genero">Género</label>
            <select name="genero" id="genero" class="form-control" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
        </div>

        <div class="form-group">
            <label for="fecha_vinculacion">Fecha de Vinculación</label>
            <input type="date" name="fecha_vinculacion" id="fecha_vinculacion" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="acuerdo_vinculacion">Acuerdo de Vinculación</label>
            <input type="file" name="acuerdo_vinculacion" id="acuerdo_vinculacion" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Crear Coordinador</button>
    </form>
@stop
