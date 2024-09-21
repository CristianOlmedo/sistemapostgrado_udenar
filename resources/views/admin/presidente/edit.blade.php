@extends('adminlte::page')

@section('title', 'Editar Presidente')

@section('content_header')
    <h1>Editar Presidente del Comité Curricular</h1>
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
            <form action="{{ route('presidente.update', $presidente->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre_completo">Nombre completo</label>
                    <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" required
                        value="{{ old('nombre_completo', $presidente->nombre_completo ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="correo_electronico">Correo electrónico</label>
                    <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" required
                        value="{{ old('correo_electronico', $presidente->correo_electronico ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="numero_identificacion">Número de identificación</label>
                    <input type="text" name="numero_identificacion" id="numero_identificacion" class="form-control"
                        required value="{{ old('numero_identificacion', $presidente->numero_identificacion ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required
                        value="{{ old('telefono', $presidente->telefono ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control"
                        value="{{ old('direccion', $presidente->direccion ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                        value="{{ old('fecha_nacimiento', $presidente->fecha_nacimiento ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="fecha_inicio_gestion">Fecha de inicio de gestión</label>
                    <input type="date" name="fecha_inicio_gestion" id="fecha_inicio_gestion" class="form-control"
                        required value="{{ old('fecha_inicio_gestion', $presidente->fecha_inicio_gestion ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="fecha_fin_gestion">Fecha de fin de gestión</label>
                    <input type="date" name="fecha_fin_gestion" id="fecha_fin_gestion" class="form-control"
                        value="{{ old('fecha_fin_gestion', $presidente->fecha_fin_gestion ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="departamento_o_facultad">Departamento o Facultad</label>
                    <input type="text" name="departamento_o_facultad" id="departamento_o_facultad" class="form-control"
                        required value="{{ old('departamento_o_facultad', $presidente->departamento_o_facultad ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="programa_academico">Programa Académico:</label>
                    <input type="text" name="programa_academico" id="programa_academico" class="form-control" required
                        value="{{ old('programa_academico', $presidente->programa_academico ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="Activo"
                            {{ old('estado', $presidente->estado ?? '') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo"
                            {{ old('estado', $presidente->estado ?? '') == 'Inactivo' ? 'selected' : '' }}>Inactivo
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="resolucion_nombramiento">Resoluciones o Nombramientos (opcional)</label>
                    <input type="file" name="resolucion_nombramiento" class="form-control-file" accept=".pdf">
                    @if ($presidente->resolucion_nombramiento)
                        <p><a href="{{ Storage::url($presidente->resolucion_nombramiento) }}" target="_blank">Ver
                                Resolución Actual</a></p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('presidente.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
