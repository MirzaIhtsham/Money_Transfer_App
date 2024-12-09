<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Layout</title>
    <!-- Add custom CSS or link to your stylesheet here -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    @stack('css') <!-- To push custom CSS for individual pages -->
</head>
<body class="hold-transition login-page">

    <!-- Main Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">MyApp</a>
            <div class="ml-auto">
                <!-- Login & Register buttons for guest users -->
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary ml-2">Register</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container mt-5">
        @yield('content')  <!-- This will yield the content of the page extending this layout -->
    </div>

    <!-- Footer Section (Optional) -->
    <footer class="footer mt-5 bg-light text-center py-3">
        <div class="container">
            <span>&copy; 2024 MyApp. All rights reserved.</span>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    @stack('js') <!-- To push custom JS for individual pages -->

</body>
</html>
