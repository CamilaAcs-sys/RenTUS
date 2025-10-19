@extends('layouts.app')
@section('title', 'Editar Propiedad')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg rounded-4">
                <div class="card-header text-white text-center fs-4" style="background-color: #4E342E;">
                    <i class="bi bi-house-gear-fill me-2"></i>Editar Propiedad
                </div>

                <div class="card-body px-4 py-3">
                    <form action="{{ url('api/properties/' . $property['id']) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label fw-semibold">Título</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $property['title']) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label fw-semibold">Ciudad</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $property['city']) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="address" class="form-label fw-semibold">Dirección</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address', $property['address']) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="monthly_price" class="form-label fw-semibold">Precio mensual (COP)</label>
                                <input type="number" name="monthly_price" class="form-control" value="{{ old('monthly_price', $property['monthly_price']) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="num_bedrooms" class="form-label fw-semibold">Habitaciones</label>
                                <input type="number" name="num_bedrooms" class="form-control" value="{{ old('num_bedrooms', $property['num_bedrooms']) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="num_bathrooms" class="form-label fw-semibold">Baños</label>
                                <input type="number" name="num_bathrooms" class="form-control" value="{{ old('num_bathrooms', $property['num_bathrooms']) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="area_m2" class="form-label fw-semibold">Área (m²)</label>
                                <input type="number" name="area_m2" class="form-control" value="{{ old('area_m2', $property['area_m2']) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label fw-semibold">Estado</label>
                                <select name="status" class="form-select" required>
                                    <option value="disponible" {{ $property['status'] == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                    <option value="ocupado" {{ $property['status'] == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="included_services" class="form-label fw-semibold">Servicios incluidos</label>
                                <input type="text" name="included_services" class="form-control" value="{{ old('included_services', $property['included_services']) }}">
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label fw-semibold">Descripción</label>
                                <textarea name="description" class="form-control" rows="3" required>{{ old('description', $property['description']) }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="image_url" class="form-label fw-semibold">URL de imagen</label>
                                <input type="url" name="image_url" class="form-control" value="{{ old('image_url', $property['image_url']) }}" required>
                            </div>

                            <input type="hidden" name="publication_date" value="{{ now()->format('Y-m-d') }}">

                            <div class="col-md-12">
                                <label for="user_id" class="form-label fw-semibold">Usuario propietario</label>
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
                            <a href="{{ route('home.index') }}" class="btn btn-secondary ms-2">
                                <i class="bi bi-arrow-left-circle me-1"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
