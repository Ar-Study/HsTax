@extends('layouts.guest')

@section('title', 'Lupa Password - MosqueCare')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h4 class="text-center mb-4">Lupa Password</h4>

        <p class="text-muted small mb-4">
            {{ __('Lupa password Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan tautan reset password.') }}
        </p>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    {{ __('Kirim Tautan Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</div>

<p class="text-center mt-3 mb-0">
    <small><a href="{{ route('login') }}" class="text-decoration-none">Kembali ke login</a></small>
</p>
@endsection
