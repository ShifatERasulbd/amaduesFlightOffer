<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search | Amadeus</title>

    {{-- Bootstrap 5 CDN --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    {{-- Navigation Bar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">✈️ Amadeus Flights</a>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center mt-5 mb-3 text-muted">
        &copy; {{ date('Y') }} Flight Search Demo
    </footer>

    {{-- Bootstrap JS (optional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
