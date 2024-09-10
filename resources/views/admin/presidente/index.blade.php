{{-- resources/views/presidente/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Presidente')

@section('content_header')
    <h1>Crear Presidente</h1>
@stop

@section('content')
    <p>Bienvenido a la página de creación de presidente.</p>
    
    <form action="{{ route('presidente.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">
            Crear Presidente
        </button>
    </form>


@stop

@section('css')
    {{-- Agrega aquí tus estilos adicionales --}}
@stop

@section('js')
    <script>
        console.log("Página de Presidente cargada.");
    </script>
@stop
