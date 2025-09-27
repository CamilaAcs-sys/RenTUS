@extends('layouts.app')

@section('content')
    <h1>Editar propiedad</h1>

    <form action="{{ route('properties.update', $property['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Título:</label>
        <input type="text" name="title" value="{{ $property['title'] }}" required><br>

        <label for="description">Descripción:</label>
        <textarea name="description" required>{{ $property['description'] }}</textarea><br>

        <label for="address">Dirección:</label>
        <input type="text" name="address" value="{{ $property['address'] }}" required><br>

        <label for="city">Ciudad:</label>
        <input type="text" name="city" value="{{ $property['city'] }}" required><br>

        <label for="status">Estado:</label>
        <input type="text" name="status" value="{{ $property['status'] }}" required><br>

        <label for="monthly_price">Precio mensual:</label>
        <input type="number" name="monthly_price" step="0.01" value="{{ $property['monthly_price'] }}" required><br>

        <label for="area_m2">Área en m²:</label>
        <input type="number" name="area_m2" value="{{ $property['area_m2'] }}" required><br>

        <label for="num_bedrooms">Dormitorios:</label>
        <input type="text" name="num_bedrooms" value="{{ $property['num_bedrooms'] }}" required><br>

        <label for="num_bathrooms">Baños:</label>
        <input type="text" name="num_bathrooms" value="{{ $property['num_bathrooms'] }}" required><br>

        <label for="included_services">Servicios incluidos:</label>
        <input type="text" name="included_services" value="{{ $property['included_services'] }}"><br>

        <label for="publication_date">Fecha de publicación:</label>
        <input type="date" name="publication_date" value="{{ $property['publication_date'] }}" required><br>

        <label for="image_url">URL de la imagen:</label>
        <input type="text" name="image_url" value="{{ $property['image_url'] }}"><br>

        <label for="user_id">ID del usuario:</label>
        <input type="number" name="user_id" value="{{ $property['user_id'] }}" required><br>

        <button type="submit">Actualizar propiedad</button>
    </form>
@endsection
