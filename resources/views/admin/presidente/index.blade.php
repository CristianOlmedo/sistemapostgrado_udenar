@extends('adminlte::page')

@section('title', 'Presidente')

@section('content_header')
    <h1>Lista de Presidentes</h1>
@stop

@section('content')
    <p>Bienvenido a la página de gestión de presidentes.</p>

    {{-- Botón para crear un nuevo presidente --}}
    <form action="{{ route('presidente.create') }}" method="GET">
        <button type="submit" class="btn btn-primary mb-3">
            Crear Presidente
        </button>
    </form>

    {{-- Tabla de presidentes --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre Completo</th>
                <th>Correo Electrónico</th>
                <th>Número de Identificación</th>
                <th>Teléfono</th>
                <th>Departamento o Facultad</th>
                <th>Programa Académico</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presidentes as $presidente)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $presidente->nombre_completo }}</td>
                    <td>{{ $presidente->correo_electronico }}</td>
                    <td>{{ $presidente->numero_identificacion }}</td>
                    <td>{{ $presidente->telefono }}</td>
                    <td>{{ $presidente->departamento_o_facultad }}</td>
                    <td>{{ $presidente->programa_academico }}</td>
                    <td>{{ $presidente->estado ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        {{-- Botones de editar y eliminar --}}
                        <a href="{{ route('presidente.edit', $presidente->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('presidente.destroy', $presidente->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $presidente->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $presidente->id }})">Eliminar</button>
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
