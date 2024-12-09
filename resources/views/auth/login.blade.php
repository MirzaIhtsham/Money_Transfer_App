@extends('layouts.guests.guest')

@push('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<style>
    /* Centering only the login-box on the screen */
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background-color: #f4f6f9; /* Optional: background color */
    }

    .login-box {
        width: 100%;
        max-width: 400px; /* Max width of the login box */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); /* Center it using transform */
    }

    .login-logo a {
        font-size: 30px;
        font-weight: bold;
    }

    .card {
        border-radius: 8px; /* Optional: to round the corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: add shadow */
    }

    /* Styling error messages */
    .is-invalid {
        border-color: #dc3545;
    }

    .text-danger {
        font-size: 12px;
    }
</style>
@endpush

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Login</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Login to Money Transfer</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <!-- Email Input Field -->
                <div class="input-group mb-3">
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        placeholder="Email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <!-- Password Input Field -->
                <div class="input-group mb-3">
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        placeholder="Password" 
                        required 
                        autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
