@extends('layouts.app')

@section('title', 'Detalle de Propiedad - RentUs')

@section('content')
@php
  // URL base de la API (configurable desde .env)
  $apiUrl = rtrim(env('URL_SERVER_API', 'http://api.backrentus'), '/');
@endphp

<section class="py-5">
  <div class="container">
    <div class="row g-5">
      {{-- Imagen principal --}}
      <div class="col-md-6">
        <div class="w-100">
          <img 
            src="{{ $property['image_url'] }}" 
            alt="{{ $property['title'] }}" 
            class="w-100 rounded shadow-sm"
            style="object-fit: cover; height: 100%; max-height: 450px;"
          >
        </div>
      </div>

      {{-- Detalles --}}
      <div class="col-md-6">
        <h2 class="fw-bold">{{ $property['title'] }}</h2>
        <h5 class="text-muted mb-3">
          <i class="bi bi-geo-alt-fill me-1"></i>{{ $property['address'] }}, {{ $property['city'] }}
        </h5>

        <ul class="list-unstyled mt-3 mb-4">
          <li><strong>Estado:</strong> {{ ucfirst($property['status']) }}</li>
          <li><strong>Precio mensual:</strong> ${{ number_format((float) $property['monthly_price'], 0, ',', '.') }}</li>
          <li><strong>Área:</strong> {{ $property['area_m2'] }} m²</li>
          <li><strong>Habitaciones:</strong> {{ $property['num_bedrooms'] }}</li>
          <li><strong>Baños:</strong> {{ $property['num_bathrooms'] }}</li>
          <li><strong>Servicios incluidos:</strong> {{ $property['included_services'] ?? 'No especificado' }}</li>
          <li><strong>Publicado:</strong> {{ $property['publication_date'] ?? 'Sin fecha' }}</li>
          <li><strong>Descripción:</strong> {{ ucfirst($property['description']) }}</li>
        </ul>

        {{-- Acciones --}}
        <div class="d-flex flex-wrap gap-2 mt-4">
          
          {{-- Volver al home --}}
          <a href="{{ route('home.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left-circle me-1"></i> Volver
          </a>

         
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Script para eliminar propiedad --}}
<script>
  const API_URL = "{{ $apiUrl }}/api/properties";

  async function eliminarPropiedad(id) {
    if (!confirm('¿Estás seguro de que deseas eliminar esta propiedad?')) return;

    try {
      const response = await fetch(`${API_URL}/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
          // Si tu API requiere token, agrega:
          // 'Authorization': 'Bearer {{ session('token') }}'
        }
      });

      if (response.ok) {
        alert('✅ Propiedad eliminada correctamente.');
        window.location.href = "{{ route('properties.index') }}";
      } else {
        const data = await response.json();
        throw new Error(data.message || 'Error al eliminar la propiedad.');
      }

    } catch (error) {
      alert('❌ Error: ' + error.message);
    }
  }
</script>
@endsection
