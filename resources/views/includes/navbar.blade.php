<header class="navbar navbar-expand-lg" style="background-color: #EFE7DC;">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('home.index') }}">
      <img src="{{ asset('img/LogoRentUs.jpg') }}" alt="RentUs Logo" height="40" class="me-2">
      <div class="fw-bold text-dark fs-4" style="letter-spacing: 5px;">Rent<span class="text-muted">Us</span></div>
    </a>

    <!-- Botón responsive -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold" href="{{ route('home.index') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('properties.index') }}">Administrar Propiedades</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold" href="{{ route('about.index') }}">Sobre Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-dark fw-semibold ms-lg-3" href="#">Iniciar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</header>