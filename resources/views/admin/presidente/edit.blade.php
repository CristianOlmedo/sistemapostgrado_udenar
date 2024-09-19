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
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $presidente->nombre) }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control"
                        value="{{ old('correo', $presidente->correo) }}" required>
                </div>

                <div class="form-group">
                    <label for="identificacion">Número de Identificación</label>
                    <input type="text" name="identificacion" class="form-control"
                        value="{{ old('identificacion', $presidente->identificacion) }}" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control"
                        value="{{ old('telefono', $presidente->telefono) }}" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control"
                        value="{{ old('direccion', $presidente->direccion) }}" required>
                </div>

                <div class="form-group">
                    <label for="departamento">Departamento o Facultad</label>
                    <input type="text" name="departamento" class="form-control"
                        value="{{ old('departamento', $presidente->departamento) }}" required>
                </div>

                <div class="form-group">
                    <label for="programa_academico_id">Programa Académico</label>
                    <select name="programa_academico_id" class="form-control" required>
                        <option value="">Seleccione un programa</option>
                        @foreach ($programas as $programa)
                            <option value="{{ $programa->id }}"
                                {{ old('programa_academico_id', $presidente->programa_academico_id) == $programa->id ? 'selected' : '' }}>
                                {{ $programa->nombre_programa }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento (opcional)</label>
                    <input type="date" name="fecha_nacimiento" class="form-control"
                        value="{{ old('fecha_nacimiento', $presidente->fecha_nacimiento) }}">
                </div>

                <div class="form-group">
                    <label for="fecha_inicio_gestion">Fecha de Inicio de Gestión</label>
                    <input type="date" name="fecha_inicio_gestion" class="form-control"
                        value="{{ old('fecha_inicio_gestion', $presidente->fecha_inicio_gestion) }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha_fin_gestion">Fecha de Fin de Gestión (opcional)</label>
                    <input type="date" name="fecha_fin_gestion" class="form-control"
                        value="{{ old('fecha_fin_gestion', $presidente->fecha_fin_gestion) }}">
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="Activo" {{ old('estado', $presidente->estado) == 'Activo' ? 'selected' : '' }}>
                            Activo</option>
                        <option value="Inactivo" {{ old('estado', $presidente->estado) == 'Inactivo' ? 'selected' : '' }}>
                            Inactivo</option>
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
