@extends('layouts.app')

@section('title', 'Detalle de Propiedad - RentUs')

@section('content')
<section class="py-5">
  <div class="container">
    <div class="row g-5">
      <div class="col-md-6">
        <div class="w-100">
          <img src="{{ $property['image_url'] }}" alt="{{ $property['title'] }}" class="w-100 rounded shadow-sm" style="object-fit: cover; height: 100%; max-height: 450px;">
        </div>
      </div>

      <div class="col-md-6">
        <h2 class="fw-bold">{{ $property['title'] }}</h2>
        <h4><strong>Dirección: </strong><p class="text-muted">{{ $property['address'] }}, {{ $property['city'] }} </p></h4>

        <ul class="list-unstyled mt-3 mb-4">
          <li><strong>Estado:</strong> {{ ucfirst($property['status']) }}</li>
          <li><strong>Precio mensual:</strong> ${{ number_format((float) $property['monthly_price'], 0, ',', '.') }}</li>
          <li><strong>Área:</strong> {{ $property['area_m2'] }} m²</li>
          <li><strong>Habitaciones:</strong> {{ $property['num_bedrooms'] }}</li>
          <li><strong>Baños:</strong> {{ $property['num_bathrooms'] }}</li>
          <li><strong>Servicios incluidos:</strong> {{ $property['included_services'] }}</li>
          <li><strong>Publicado:</strong> {{ $property['publication_date'] }}</li>
          <li><strong>Descripción:</strong> {{ ucfirst($property['description']) }}</li>
        </ul>

        <div class="d-flex flex-wrap gap-2 mt-4">
          {{-- Editar propiedad --}}
          <a href="{{ route('properties.edit', ['property' => $property['id']]) }}" class="btn btn-primary">
            <i class="bi bi-pencil-square me-1"></i> Editar
          </a>

          {{-- Volver al home --}}
          <a href="{{ route('home.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-x-circle me-1"></i> Cancelar
          </a>

          {{-- Eliminar propiedad vía fetch --}}
          <button type="button" class="btn btn-danger" onclick="eliminarPropiedad({{ $property['id'] }})">
            <i class="bi bi-trash3 me-1"></i> Eliminar
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function eliminarPropiedad(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta propiedad?')) {
      fetch(`http://api.test/api/properties/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          // Agrega 'Authorization' si tu API lo requiere
        }
      })
      .then(response => {
        if (response.ok) {
          alert('Propiedad eliminada correctamente.');
          window.location.href = "{{ route('home.index') }}";
        } else {
          return response.json().then(data => {
            throw new Error(data.message || 'Error al eliminar la propiedad.');
          });
        }
      })
      .catch(error => {
        alert('Error: ' + error.message);
      });
    }
  }
</script>
@endsection
