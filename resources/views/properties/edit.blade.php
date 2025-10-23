@extends('layouts.app')
@section('title', 'Editar Propiedad')

@section('content')
@php
    $apiUrl = rtrim(env('URL_SERVER_API', 'http://api.backrentus'), '/');
@endphp

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg rounded-4">
                <div class="card-header text-white text-center fs-4" style="background-color: #4E342E;">
                    <i class="bi bi-house-gear-fill me-2"></i>Editar Propiedad
                </div>

                <div class="card-body px-4 py-3">
                    <form id="editPropertyForm">
                        @csrf
                        @method('PUT')

                        {{-- Campos --}}
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Título</label>
                                <input type="text" name="title" class="form-control" value="{{ $property['title'] }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Ciudad</label>
                                <input type="text" name="city" class="form-control" value="{{ $property['city'] }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Dirección</label>
                                <input type="text" name="address" class="form-control" value="{{ $property['address'] }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Precio mensual (COP)</label>
                                <input type="number" name="monthly_price" class="form-control" value="{{ $property['monthly_price'] }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Habitaciones</label>
                                <input type="number" name="num_bedrooms" class="form-control" value="{{ $property['num_bedrooms'] }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Baños</label>
                                <input type="number" name="num_bathrooms" class="form-control" value="{{ $property['num_bathrooms'] }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Área (m²)</label>
                                <input type="number" name="area_m2" class="form-control" value="{{ $property['area_m2'] }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Estado</label>
                                <select name="status" class="form-select" required>
                                    <option value="disponible" {{ $property['status'] == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                    <option value="ocupado" {{ $property['status'] == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Servicios incluidos</label>
                                <input type="text" name="included_services" class="form-control" value="{{ $property['included_services'] }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Descripción</label>
                                <textarea name="description" class="form-control" rows="3" required>{{ $property['description'] }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">URL de imagen</label>
                                <input type="url" name="image_url" class="form-control" value="{{ $property['image_url'] }}" required>
                            </div>

                            <input type="hidden" name="publication_date" value="{{ now()->format('Y-m-d') }}">

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Usuario propietario</label>
                                <select name="user_id" class="form-select" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user['id'] }}" {{ $property['user_id'] == $user['id'] ? 'selected' : '' }}>
                                            {{ $user['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-arrow-repeat me-1"></i> Actualizar
                            </button>
                            <a href="{{ route('properties.index') }}" class="btn btn-secondary ms-2">
                                <i class="bi bi-arrow-left-circle me-1"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('editPropertyForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const jsonData = Object.fromEntries(formData.entries());

    try {
        const response = await fetch(`{{ $apiUrl }}/api/properties/{{ $property['id'] }}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(jsonData)
        });

        const result = await response.json();

        if (!response.ok) throw new Error(result.message || 'Error al actualizar la propiedad.');

        alert('✅ Propiedad actualizada correctamente');
        window.location.href = "{{ route('properties.show', ['id' => $property['id']]) }}";

    } catch (error) {
        alert('❌ ' + error.message);
    }
});
</script>
@endsection
