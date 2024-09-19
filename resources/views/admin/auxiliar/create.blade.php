@extends('adminlte::page')

@section('title', 'Crear Auxiliar')

@section('content_header')
    <h1>Crear NuevO Auxiliar</h1>
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
            <form action="{{ route('auxiliar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>   
                </div>

                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" name="correo" id="correo" class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label for="identificacion">Número de identificación</label>
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
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
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
                    <label for="fecha_vinculacion">Fecha de Vinculación</label>
                    <input type="date" name="fecha_vinculacion" id="fecha_vinculacion" class="form-control">
                </div>

                <div class="form-group">
                    <label for="acuerdo_vinculacion">Acuerdo de Vinculación</label>
                    <input type="file" name="acuerdo_vinculacion" id="acuerdo_vinculacion" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('auxiliar.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
