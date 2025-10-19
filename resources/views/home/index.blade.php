@extends('layouts.app')

@section('title', 'Inicio - RentUs')

@section('content')

<section class="py-5 bg-light">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold mb-0">Propiedades disponibles</h2>
      <a href="{{ route('properties.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Nueva Propiedad
      </a>
    </div>

    <div class="row" id="property-list">
      {{-- Aquí se insertan las tarjetas vía JavaScript --}}
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    fetch('http://api.test/api/properties')
      .then(response => response.json())
      .then(data => renderProperties(data))
      .catch(error => console.error('Error al cargar propiedades:', error));
  });

  function renderProperties(properties) {
    const container = document.getElementById('property-list');
    container.innerHTML = ''; // Limpiar

    if (properties.length === 0) {
      container.innerHTML = '<p class="text-muted">No hay propiedades registradas.</p>';
      return;
    }

    properties.forEach(property => {
      const card = document.createElement('div');
      card.classList.add('col-md-4', 'mb-4');
      card.innerHTML = `
        <div class="card h-100 shadow-sm">
          <img src="${property.image_url}" class="card-img-top" alt="${property.title}" style="height: 220px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">${property.title}</h5>
            <p class="card-text">${property.city} - ${property.address}</p>
            <p class="fw-bold mb-2">$${parseFloat(property.monthly_price).toLocaleString()}</p>
            <a href="/properties/${property.id}" class="btn btn-primary mt-auto">
              <i class="bi bi-eye me-1"></i> Ver detalles
            </a>
          </div>
        </div>
      `;
      container.appendChild(card);
    });
  }
</script>
@endsection
