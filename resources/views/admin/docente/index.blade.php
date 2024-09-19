@extends('adminlte::page')

@section('title', 'Listado de Docentes')

@section('content_header')
    <h1>Listado de Docentes</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('docente.create') }}" class="btn btn-primary">Crear Nuevo Docente</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Identificación</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Genero</th>
                        <th>Fecha de nacimiento</th>
                        <th>Formación Academica</th>
                        <th>Area de conocimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($docentes as $docente)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $docente->nombre }}</td>
                            <td>{{ $docente->identificacion }}</td>
                            <td>{{ $docente->direccion }}</td>
                            <td>{{ $docente->telefono }}</td>
                            <td>{{ $docente->correo }}</td>
                            <td>{{ $docente->genero }}</td>
                            <td>{{ $docente->fecha_nacimiento }}</td>
                            <td>{{ $docente->formacion_academica }}</td>
                            <td>{{ $docente->area_conocimiento }}</td>
                            <td>
                                <a href="{{ route('docente.edit', $docente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('docente.destroy', $docente->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar este docente?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No hay docentes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        @if (Session::has('swal:success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ Session::get("swal:success") }}'
            });
        @endif

        @if (Session::has('swal:error'))
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ Session::get("swal:error") }}'
            });
        @endif
    </script>
@stop
