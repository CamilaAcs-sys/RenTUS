@extends('layouts.app')

@section('title', 'Sobre Nosotros | Rentus')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <!-- Encabezado -->
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 text-dark mb-3">
                Sobre <span class="text-primary">Rentus</span>
            </h1>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Conectamos a propietarios e inquilinos a través de tecnología moderna y una experiencia segura y transparente.
            </p>

            <!-- 🔹 Botones de traducción -->
            <div class="mt-4">
                <button class="btn btn-primary me-2" onclick="traducirAbout('en')">
                    🇺🇸 Traducir al inglés
                </button>
                <button class="btn btn-secondary" onclick="revertirAbout()">
                    🇪🇸 Volver al español
                </button>
            </div>

            <!-- 🔹 Loader (mensaje mientras traduce) -->
            <div id="loader" class="mt-3 text-muted fw-semibold" style="display: none;">
                Traduciendo contenido...
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="row align-items-center g-5">
            <!-- Imagen -->
            <div class="col-md-6">
                <div class="text-center">
                    <img src="{{ asset('img/LogoRentUs.jpg') }}" 
                         alt="Rentus plataforma inmobiliaria"
                         class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>

            <!-- Texto -->
            <div class="col-md-6">
                <p class="text-secondary fs-5">
                    <strong>Rentus</strong> es una plataforma digital diseñada para conectar a propietarios y arrendatarios
                    de forma segura, práctica y eficiente. Nuestro objetivo es simplificar el proceso de 
                    <span class="text-primary fw-semibold">publicar, gestionar y arrendar propiedades</span>
                    mediante herramientas tecnológicas intuitivas y transparentes.
                </p>

                <p class="text-secondary fs-5">
                    Ya sea que quieras ofrecer tu inmueble en alquiler o encontrar el lugar ideal para vivir o invertir,
                    Rentus te ofrece todo en un mismo espacio. Con una interfaz moderna y un sistema automatizado, podrás
                    administrar tus propiedades sin complicaciones.
                </p>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>Registrar propiedades con imágenes, descripciones y precios personalizados.</li>
                    <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>Acceder a un amplio catálogo de inmuebles disponibles.</li>
                    <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>Comunicación directa entre arrendadores e inquilinos.</li>
                    <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>Gestión de contratos y disponibilidad en tiempo real.</li>
                </ul>

                <p class="text-secondary fs-5">
                    En Rentus creemos en la <strong>digitalización del mercado inmobiliario</strong> y en brindar una experiencia
                    basada en la confianza, la rapidez y la transparencia.
                </p>

                <div class="mt-4">
                    <h3 class="fw-bold text-dark mb-2">Nuestra misión</h3>
                    <p class="text-secondary fs-5">Facilitar la conexión entre personas y propiedades.</p>

                    <h3 class="fw-bold text-dark mt-4 mb-2">Nuestra visión</h3>
                    <p class="text-secondary fs-5">
                        Ser la plataforma líder en gestión de arriendos en Latinoamérica, impulsando la innovación
                        y la confianza en cada transacción.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    @vite(['resources/js/about.js'])
@endpush
