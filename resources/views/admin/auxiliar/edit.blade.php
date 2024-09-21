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
            <form action="{{ route('auxiliar.update', $auxiliar->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $auxiliar->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo Electronico</label>
                    <input type="text" name="correo" class="form-control" value="{{ old('correo', $auxiliar->correo) }}" required>
                </div>

                <div class="form-group">
                    <label for="identificacion">Número de identificación</label>
                    <input type="text" name="identificacion" class="form-control" value="{{ old('identificacion', $auxiliar->identificacion) }}" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $auxiliar->telefono) }}" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $auxiliar->direccion) }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $auxiliar->fecha_nacimiento) }}" required>
                </div>

                <div class="form-group">
                    <label for="genero">Genero</label>
                    <select name="genero" id="genero" class="form-control" value="{{ old('genero', $auxiliar->genero) }}" required>
                        <option value="">Seleccionar</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="programa_academico_id">Programa Académico</label>
                    <select name="programa_academico_id" class="form-control" required>
                        <option value="">Seleccione un programa</option>
                        @foreach ($programas as $programa)
                            <option value="{{ $programa->id }}" {{ old('programa_academico_id') == $programa->id ? 'selected' : '' }}>
                                {{ $programa->nombre_programa }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_vinculacion">Fecha de Nacimiento</label>fecha_vinculacion
                    <input type="date" name="fecha_vinculacion" class="form-control" value="{{ old('fecha_vinculacion', $auxiliar->fecha_vinculacion) }}" required>
                </div>

                <div class="form-group">
                    <label for="acuerdo_vinculacion">Acuerdo de Vinculación</label>
                    <input type="file" name="acuerdo_vinculacion" id="acuerdo_vinculacion" value="{{ old('acuerdo_vinculacion', $auxiliar->acuerdo_vinculacion) }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('auxiliar.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
