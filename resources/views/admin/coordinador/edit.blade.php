@extends('adminlte::page')

@section('title', 'Editar Coordinador')

@section('content_header')
    <h1>Editar Coordinador</h1>
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
            <form action="{{ route('coordinador.update', $coordinador) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control"
                        value="{{ old('nombre', $coordinador->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="identificacion">Identificación</label>
                    <input type="text" name="identificacion" class="form-control"
                        value="{{ old('identificacion', $coordinador->identificacion) }}" required>
                </div>

                <div class="form-group">
                    <label for="programa_academico_id">Programa Académico</label>
                    <select name="programa_academico_id" class="form-control" required>
                        <option value="">Seleccione un programa</option>
                        @foreach ($programas as $programa)
                            <option value="{{ $programa->id }}"
                                {{ old('programa_academico_id', $coordinador->programa_academico_id) == $programa->id ? 'selected' : '' }}>
                                {{ $programa->nombre_programa }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control"
                        value="{{ old('direccion', $coordinador->direccion) }}" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control"
                        value="{{ old('telefono', $coordinador->telefono) }}" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" class="form-control"
                        value="{{ old('correo', $coordinador->correo) }}" required>
                </div>

                <div class="form-group">
                    <label for="genero">Género</label>
                    <select name="genero" class="form-control" required>
                        <option value="">Seleccione el género</option>
                        <option value="Masculino"
                            {{ old('genero', $coordinador->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('genero', $coordinador->genero) == 'Femenino' ? 'selected' : '' }}>
                            Femenino</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control"
                        value="{{ old('fecha_nacimiento', $coordinador->fecha_nacimiento) }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha_vinculacion">Fecha de Vinculación</label>
                    <input type="date" name="fecha_vinculacion" class="form-control"
                        value="{{ old('fecha_vinculacion', $coordinador->fecha_vinculacion) }}" required>
                </div>

                <div class="form-group">
                    <label for="acuerdo_vinculacion">Acuerdo de Vinculación (PDF)</label>
                    <input type="file" name="acuerdo_vinculacion" class="form-control-file" accept=".pdf">
                    @if ($coordinador->acuerdo_vinculacion)
                        <p><a href="{{ Storage::url($coordinador->acuerdo_vinculacion) }}" target="_blank">Ver Acuerdo
                                Actual</a></p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('coordinador.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
