@extends('adminlte::page')

@section('title', 'Estudiante')

@section('content_header')
    <h1>Lista de Estudiantes</h1>
@stop

@section('content')
    <p>Bienvenido a la página de gestión de estudiantes.</p>

    {{-- Botón para crear un nuevo Estudiante --}}
    <form action="{{ route('estudiante.create') }}" method="GET">
        <button type="submit" class="btn btn-primary mb-3">
            Crear Estudiante
        </button>
    </form>

    {{-- Tabla de programas académicos --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>código estudiantíl</th>
                <th>Cohorte</th>
                <th>Nombre Estudiante</th>
                <th>Identificación</th>
                <th>Foto</th>
                <th>Dirección</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Genero</th>
                <th>Fecha de Nacimiento</th>
                <th>Semestre</th>
                <th>Fecha de Ingreso</th>
                <th>Fecha de Egreso</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $estudiante->codigo_estudiantil }}</td>
                    <td>{{ $estudiante->nombre }}</td>
                    <td>{{ $estudiante->cohorte->nombre ?? 'N/A'  }}</td>
                    <td>{{ $estudiante->identificacion }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $estudiante->foto) }}" alt="Foto" width="100">
                    </td>
                    <td>{{ $estudiante->correo }}</td>
                    <td>{{ $estudiante->genero }}</td>
                    <td>{{ $estudiante->fecha_nacimiento}}</td>
                    <td>{{ $estudiante->semestre }}</td>
                    <td>{{ $estudiante->fecha_ingreso}}</td>
                    <td>{{ $estudiante->fecha_egreso}}</td>
                    <td>
                        {{-- Botones de editar y eliminar --}}
                        <a href="{{ route('estudiante.edit', $estudiante->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('estudiante.destroy', $estudiante->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $estudiante->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $estudiante->id }})">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    {{-- Agrega aquí tus estilos adicionales --}}
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(Session::has('swal:success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: "{{ Session::get('swal:success') }}",
                    showConfirmButton: true
                });
            @endif

            @if(Session::has('swal:error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ Session::get('swal:error') }}",
                    showConfirmButton: true
                });
            @endif
        });

        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás recuperar este registro!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@stop
