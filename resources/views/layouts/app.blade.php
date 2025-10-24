<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rentus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">
    
    @include('includes.navbar') 

    <main class="flex-fill container py-4">
        @yield('content') 
    </main>

    <footer class="mt-auto">
        @include('includes.footer')
    </footer>

    {{-- 👇 Aquí Laravel inyectará los scripts personalizados de cada vista --}}
    @stack('scripts')

</body>
</html>
