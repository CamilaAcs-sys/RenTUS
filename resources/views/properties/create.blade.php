@extends('layouts.app')

@section('content')
    <h2>Crear Propiedad</h2>

    <form action="{{ route('properties.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Título:</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Dirección:</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ciudad:</label>
            <input type="text" name="city" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado:</label>
            <input type="text" name="status" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio mensual:</label>
            <input type="number" step="0.01" name="monthly_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Área (m²):</label>
            <input type="number" name="area_m2" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Dormitorios:</label>
            <input type="number" name="num_bedrooms" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Baños:</label>
            <input type="number" name="num_bathrooms" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Servicios incluidos:</label>
            <input type="text" name="included_services" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de publicación:</label>
            <input type="date" name="publication_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">URL de imagen:</label>
            <input type="text" name="image_url" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ID del propietario (user_id):</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection

