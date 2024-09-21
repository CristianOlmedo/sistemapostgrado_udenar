@extends('adminlte::page')

@section('title', 'Editar Docente')

@section('content_header')
    <h1>Editar Estudiante</h1>
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
            <form action="{{ route('estudiante.update', $estudiante->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="codigo_estudiantil">Codigo estudiantil</label>
                    <input type="text" name="codigo_estudiantil" class="form-control" value="{{ old('codigo_estudiantil', $estudiante->codigo_estudiantil) }}" required>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $estudiante->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="cohorte_id">Cohorte</label>
                    <select name="cohorte_id" class="form-control" value="{{ old('nombre', $cohorte->nombre) }}" required>
                        <option value="">Seleccione una Cohorte</option>
                        @foreach ($cohortes as $cohorte)
                            <option value="{{ $cohorte->id }}" {{ old('cohorte_id') == $cohorte->id ? 'selected' : '' }}>
                                {{ $cohorte->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div> 

                <div class="form-group">
                    <label for="identificacion">Identificacion</label>
                    <input type="text" name="identificacion" class="form-control" value="{{ old('identificacion', $estudiante->identificacion) }}" required>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto" name="foto" 
                        class="form-control-file @error('foto') is-invalid @enderror" value="{{ old('foto', $estudiante->foto) }}" required>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $estudiante->direccion) }}" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $estudiante->telefono) }}" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" class="form-control" value="{{ old('correo', $estudiante->correo) }}" required>
                </div>

                <div class="form-group">
                    <label for="genero">Genero</label>
                    <select name="genero" id="genero" class="form-control" value="{{ old('genero', $estudiante->genero) }}" required>
                        <option value="">Seleccionar</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}" required>
                </div>

                <div class="form-group">
                    <label for="semestre">Semestre</label>
                    <input type="text" name="semestre" class="form-control" value="{{ old('semestre', $estudiante->semestre) }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha_ingreso">Fecha de ingreso</label>
                    <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $estudiante->fecha_ingreso) }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha_egreso">Fecha de egreso</label>
                    <input type="date" name="fecha_egreso" class="form-control" value="{{ old('fecha_egreso', $estudiante->fecha_egreso) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('programa_academico.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
