@extends('adminlte::page')

@section('title', 'Programa Académico')

@section('content_header')
    <h1>Lista de Programas Académicos</h1>
@stop

@section('content')
    <p>Bienvenido a la página de gestión de programas académicos.</p>

    {{-- Botón para crear un nuevo programa académico --}}
    <form action="{{ route('programa_academico.create') }}" method="GET">
        <button type="submit" class="btn btn-primary mb-3">
            Crear Programa Académico
        </button>
    </form>

    {{-- Tabla de programas académicos --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Código SNIES</th>
                <th>Nombre del Programa</th>
                <th>Descripción</th>
                <th>Logo</th>
                <th>Correo</th>
                <th>Fecha de Resolución</th>
                <th>Número de Resolución</th>
                <th>Archivo de Resolución</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programas as $programa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $programa->codigo_snies }}</td>
                    <td>{{ $programa->nombre_programa }}</td>
                    <td>{{ $programa->descripcion }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $programa->logo) }}" alt="Logo" width="100">
                    </td>
                    <td>{{ $programa->correo }}</td>
                    <td>{{ $programa->fecha_resolucion->format('d/m/Y') }}</td>
                    <td>{{ $programa->numero_resolucion }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $programa->archivo_resolucion) }}" target="_blank">Ver Archivo</a>
                    </td>
                    <td>
                        {{-- Botones de editar y eliminar --}}
                        <a href="{{ route('programa_academico.edit', $programa->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('programa_academico.destroy', $programa->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $programa->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $programa->id }})">Eliminar</button>
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
