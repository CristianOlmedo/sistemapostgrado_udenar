@extends('adminlte::page')

@section('title', 'Crear Estudiante')

@section('content_header')
    <h1>Crear Estudiante</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Mostrar mensajes de error y éxito -->
            @if (session('swal:success'))
                <div class="alert alert-success">
                    {{ session('swal:success') }}
                </div>
            @endif
            @if (session('swal:error'))
                <div class="alert alert-danger">
                    {{ session('swal:error') }}
                </div>
            @endif

            <!-- Formulario para crear un nuevo estudiante-->
            <form action="{{ route('estudiante.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Código Estudiantíl -->
                <div class="form-group">
                    <label for="codigo_estudiantil">Código estudiantíl</label>
                    <input type="text" id="codigo_estudiantil" name="codigo_estudiantil"
                        class="form-control @error('codigo_estudiantil') is-invalid @enderror" value="{{ old('codigo_estudiantil') }}"
                        required>
                    @error('codigo_estudiantil')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nombre -->
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>   
                </div>

                <!-- Cohorte -->
                <div class="form-group">
                    <label for="cohorte_id">Cohorte</label>
                    <select name="cohorte_id" class="form-control" required>
                        <option value="">Seleccione una Cohorte</option>
                        @foreach ($cohortes as $cohorte)
                            <option value="{{ $cohorte->id }}" {{ old('cohorte_id') == $cohorte->id ? 'selected' : '' }}>
                                {{ $cohorte->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>   

                <!-- Identificacion -->
                <div class="form-group">
                    <label for="identificacion">Identificación</label>
                    <input type="text" name="identificacion" id="identificacion" class="form-control" required>
                </div>

                <!-- Foto -->
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto" name="foto" 
                        class="form-control-file @error('foto') is-invalid @enderror" required>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Direccion -->
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control">
                </div>

                <!-- Telefono -->
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                </div>

                <!-- Correo Electrónico -->
                <div class="form-group">
                    <label for="correo">correo</label>
                    <input type="text" name="correo" id="correo" class="form-control" required>
                </div>

                <!-- Genero -->
                <div class="form-group">
                    <label for="genero">Género</label>
                    <select name="genero" id="genero" class="form-control" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <!-- Fecha de nacimiento -->
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
                </div>

                <!-- Semestre-->
                <div class="form-group">
                    <label for="semestre">Semestre</label>
                    <input type="number" name="semestre" class="form-control" value="{{ old('semestre') }}" min="0" required>
                </div>

                <!-- Fecha de Ingreso -->
                <div class="form-group">
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control">
                </div>

                <!-- Fecha de Egreso -->
                <div class="form-group">
                    <label for="fecha_egreso">Fecha de Egreso</label>
                    <input type="date" name="fecha_egreso" id="fecha_egreso" class="form-control">
                </div>
                <!-- Botones de Acción -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('estudiante.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop
