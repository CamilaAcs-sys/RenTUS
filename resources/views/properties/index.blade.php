@extends('layouts.app')

@section('content')
    <h2>Listado de Propiedades</h2>

    <a href="{{ route('properties.create') }}" class="btn btn-success mb-3">+ Nueva Propiedad</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

 <table class="table">
    <thead>
        <tr>
            <th>Título</th>
            <th>Ciudad</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($properties as $property)
            <tr>
                <td>{{ $property['title'] }}</td>
                <td>{{ $property['city'] }}</td>
                <td>${{ $property['monthly_price'] }}</td>
                <td>
                    <a href="{{ route('properties.edit', $property['id']) }}" class="btn btn-warning">Editar</a>

                    <form action="{{ route('properties.destroy', $property['id']) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás segura de eliminar esta propiedad?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
