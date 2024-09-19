@extends('adminlte::page')

@section('title', 'Auxiliar')

@section('content_header')
    <h1>Lista de Auxiliares</h1>
@stop

@section('content')
    <p>Bienvenido a la página de gestión de Auxiliares.</p>

    {{-- Botón para crear un nuevo auxiliar --}}
    <form action="{{ route('auxiliar.create') }}" method="GET">
        <button type="submit" class="btn btn-primary mb-3">
            Crear Auxiliar
        </button>
    </form>

    {{-- Tabla de presidentes --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Número de Identificación</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
                <th>Programa Académico</th>
                <th>Género</th>
                <th>Fecha de Vinculación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auxiliares as $auxiliar)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $auxiliar->nombre }}</td>
                    <td>{{ $auxiliar->identificacion }}</td>
                    <td>{{ $auxiliar->telefono }}</td>
                    <td>{{ $auxiliar->correo }}</td>
                    <td>{{ $auxiliar->programa->nombre_programa ?? 'N/A' }}</td>
                    <td>{{ $auxiliar->genero }}</td>
                    <td>{{ $auxiliar->fecha_vinculacion}}</td>

                    <td>
                        {{-- Botones de editar y eliminar --}}
                        <a href="{{ route('auxiliar.edit', $auxiliar->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('auxiliar.destroy', $auxiliar->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $auxiliar->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $auxiliar->id }})">Eliminar</button>
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
