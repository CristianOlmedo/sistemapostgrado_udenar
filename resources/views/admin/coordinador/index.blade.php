{{-- resources/views/admin/coordinador/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Coordinadores')

@section('content_header')
    <h1>Lista de Coordinadores</h1>
@stop

@section('content')
    <a href="{{ route('coordinador.create') }}" class="btn btn-primary">Crear Coordinador</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Identificación</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Género</th>
                <th>Fecha de Nacimiento</th>
                <th>Fecha de Vinculación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coordinadores as $coordinador)
                <tr>
                    <td>{{ $coordinador->nombre }}</td>
                    <td>{{ $coordinador->correo }}</td>
                    <td>{{ $coordinador->identificacion }}</td>
                    <td>{{ $coordinador->telefono }}</td>
                    <td>{{ $coordinador->direccion }}</td>
                    <td>{{ $coordinador->genero }}</td>
                    <td>{{ $coordinador->fecha_nacimiento ? $coordinador->fecha_nacimiento->format('d/m/Y') : '-' }}</td>
                    <td>{{ $coordinador->fecha_vinculacion ? $coordinador->fecha_vinculacion->format('d/m/Y') : '-' }}</td>
                    <td>
                        <!-- Acciones como editar o eliminar -->
                        <a href="{{ route('coordinador.edit', $coordinador->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('coordinador.destroy', $coordinador->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de eliminar este coordinador?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
