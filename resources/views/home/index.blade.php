@extends('layouts.app')

@section('title', 'Inicio - RentUs')

@section('content')
<section class="py-5 bg-light">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold mb-0">Propiedades destacadas</h2>
      <a href="{{ route('properties.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Nueva Propiedad
      </a>
    </div>

    {{-- 🏠 Listado limitado a 9 propiedades --}}
    <div class="row">
      @forelse ($properties as $p)
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="{{ $p['image_url'] ?? 'https://via.placeholder.com/400x220?text=Sin+imagen' }}"
                 class="card-img-top" alt="{{ $p['title'] ?? 'Propiedad' }}"
                 style="height: 220px; object-fit: cover;">

            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $p['title'] ?? 'Sin título' }}</h5>
              <p class="card-text text-muted mb-1">{{ $p['city'] ?? '' }} - {{ $p['address'] ?? '' }}</p>
              <p class="fw-bold mb-3 text-success">
                ${{ number_format($p['monthly_price'] ?? 0, 0, ',', '.') }}
              </p>

              <a href="{{ route('properties.show', $p['id']) }}" class="btn btn-primary mt-auto">
                <i class="bi bi-eye me-1"></i> Ver detalles
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="text-center">
          <p class="text-muted">No hay propiedades disponibles en este momento.</p>
        </div>
      @endforelse
    </div>

    {{-- 🔗 Botón para ver todas las propiedades --}}
    <div class="text-center mt-4">
      <a href="{{ route('properties.index') }}" class="btn btn-outline-primary px-4">
        Ver todas las propiedades
      </a>
    </div>
  </div>
</section>
@endsection
