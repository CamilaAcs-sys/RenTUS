@extends('layouts.app')
@section('title', 'Nueva Propiedad')

@section('content')
<section class="py-5">
  <div class="container">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header text-center fw-bold fs-4" style="background-color: #d99227;">
        <i class="bi bi-house-add-fill me-2 text-dark"></i>Publicar Nueva Propiedad
      </div>

      <div class="card-body px-4 py-4">
        <form action="{{ route('properties.store') }}" method="POST">
          @csrf
          <div class="row g-4">
            <div class="col-md-6">
              <label for="title" class="form-label fw-semibold">Título</label>
              <input type="text" name="title" class="form-control"
                     value="{{ old('title') }}" placeholder="Ej: Apartamento en Chapinero" required>
              @error('title')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="city" class="form-label fw-semibold">Ciudad</label>
              <input type="text" name="city" class="form-control"
                     value="{{ old('city') }}" placeholder="Ej: Bogotá" required>
              @error('city')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="address" class="form-label fw-semibold">Dirección</label>
              <input type="text" name="address" class="form-control"
                     value="{{ old('address') }}" placeholder="Calle 123 #45-67" required>
              @error('address')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="monthly_price" class="form-label fw-semibold">Precio mensual (COP)</label>
              <input type="number" name="monthly_price" class="form-control"
                     value="{{ old('monthly_price') }}" required>
              @error('monthly_price')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-4">
              <label for="num_bedrooms" class="form-label fw-semibold">Habitaciones</label>
              <input type="number" name="num_bedrooms" class="form-control"
                     value="{{ old('num_bedrooms') }}" required>
              @error('num_bedrooms')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-4">
              <label for="num_bathrooms" class="form-label fw-semibold">Baños</label>
              <input type="number" name="num_bathrooms" class="form-control"
                     value="{{ old('num_bathrooms') }}" required>
              @error('num_bathrooms')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-4">
              <label for="area_m2" class="form-label fw-semibold">Área (m²)</label>
              <input type="number" name="area_m2" class="form-control"
                     value="{{ old('area_m2') }}" required>
              @error('area_m2')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="status" class="form-label fw-semibold">Estado</label>
              <select name="status" class="form-select" required>
                <option value="">-- Selecciona un estado --</option>
                <option value="disponible" {{ old('status') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="ocupado" {{ old('status') == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
              </select>
              @error('status')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="included_services" class="form-label fw-semibold">Servicios incluidos</label>
              <input type="text" name="included_services" class="form-control"
                     value="{{ old('included_services') }}" placeholder="Ej: Agua, Luz, Internet">
            </div>

            <div class="col-md-12">
              <label for="description" class="form-label fw-semibold">Descripción</label>
              <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
              @error('description')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-12">
              <label for="image_url" class="form-label fw-semibold">URL de imagen</label>
              <input type="url" name="image_url" class="form-control"
                     value="{{ old('image_url') }}" required>
              @error('image_url')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <input type="hidden" name="publication_date" value="{{ now()->format('Y-m-d') }}">

            <div class="col-md-6">
              <label for="user_id" class="form-label fw-semibold">Usuario propietario</label>
              <select name="user_id" class="form-select" required>
                <option value="">-- Selecciona un usuario --</option>
                @foreach($users as $user)
                  <option value="{{ $user['id'] }}" {{ old('user_id') == $user['id'] ? 'selected' : '' }}>
                    {{ $user['name'] }} (ID: {{ $user['id'] }})
                  </option>
                @endforeach
              </select>
              @error('user_id')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-12 d-flex justify-content-between gap-3">
              <button type="submit" class="btn btn-dark flex-fill">
                <i class="bi bi-upload me-1"></i> Publicar Propiedad
              </button>
              <a href="{{ route('home.index') }}" class="btn btn-outline-secondary flex-fill">
                <i class="bi bi-x-circle me-1"></i> Cancelar
              </a>
            </div>
          </div>
        </form>

        @if(session('success'))
        <div class="alert alert-success mt-4">
          {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger mt-4">
          {{ session('error') }}
        </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection
