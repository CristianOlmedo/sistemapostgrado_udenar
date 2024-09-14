@extends('adminlte::page')

@section('title', 'Listado de Cohortes')

@section('content_header')
    <h1>Listado de Cohortes</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('cohorte.create') }}" class="btn btn-primary">Crear Nueva Cohorte</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Programa</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Número de Estudiantes Matriculados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cohortes as $cohorte)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cohorte->codigo }}</td>
                            <td>{{ $cohorte->nombre }}</td>
                            <td>{{ $cohorte->programa->nombre_programa }}</td>
                            <td>{{ $cohorte->fecha_inicio }}</td>
                            <td>{{ $cohorte->fecha_fin }}</td>
                            <td>{{ $cohorte->numero_estudiantes_matriculados }}</td>
                            <td>
                                <a href="{{ route('cohorte.edit', $cohorte->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('cohorte.destroy', $cohorte->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar esta cohorte?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No hay cohortes registradas.</td>
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
