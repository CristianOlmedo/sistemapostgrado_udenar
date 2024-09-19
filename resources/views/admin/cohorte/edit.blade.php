    @extends('adminlte::page')

    @section('title', 'Editar Cohorte')

    @section('content_header')
        <h1>Editar Cohorte</h1>
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
                <form action="{{ route('cohorte.update', $cohorte->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="text" name="codigo" class="form-control" value="{{ old('codigo', $cohorte->codigo) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre', $cohorte->nombre) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="programa_id">Programa Académico</label>
                        <select name="programa_id" class="form-control" required>
                            <option value="">Seleccione un programa</option>
                            @foreach ($programas as $programa)
                                <option value="{{ $programa->id }}"
                                    {{ old('programa_id', $cohorte->programa_id) == $programa->id ? 'selected' : '' }}>
                                    {{ $programa->nombre_programa }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control"
                            value="{{ old('fecha_inicio', $cohorte->fecha_inicio) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" class="form-control"
                            value="{{ old('fecha_fin', $cohorte->fecha_fin) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="numero_estudiantes_matriculados">Número de Estudiantes Matriculados</label>
                        <input type="number" name="numero_estudiantes_matriculados" class="form-control"
                            value="{{ old('numero_estudiantes_matriculados', $cohorte->numero_estudiantes_matriculados) }}"
                            min="0" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('cohorte.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    @stop