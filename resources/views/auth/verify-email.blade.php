@extends('layouts.guest')

@section('title', 'Verifikasi Email - MosqueCare')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h4 class="text-center mb-4">Verifikasi Email</h4>

        <div class="alert alert-info">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan ulang.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none text-muted">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
