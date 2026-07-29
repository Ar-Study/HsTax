@extends('layouts.guest')
@section('title', 'Login - HS Tax Admin')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <h4 class="text-center mb-4 fw-bold" style="color:#5A0D0D;">Login Admin</h4>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Email</label>
                <input type="email" name="email" id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-medium">Password</label>
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none small">Lupa password?</a>
                @endif
                <button type="submit" class="btn" style="background:#8B1A1A;color:#fff;border:none;padding:10px 28px;border-radius:50px;font-weight:600;">Login</button>
            </div>
        </form>
    </div>
</div>
<p class="text-center mt-3 mb-0">
    <small>Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none" style="color:#8B1A1A;">Daftar</a></small>
</p>
@endsection
