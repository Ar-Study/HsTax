<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'MosqueCare'))</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body style="background: linear-gradient(135deg, #f8f6f0 0%, #e8f0e8 100%);">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4">
                    <div style="width:60px;height:60px;border-radius:1rem;background:linear-gradient(135deg,#2d6a4f,#52b788);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;color:#fff;font-size:1.5rem;">
                        <i class="bi bi-building"></i>
                    </div>
                    <h1 class="h3" style="color:#1b4332;font-weight:700;">{{ config('app.name', 'MosqueCare') }}</h1>
                    <p class="text-muted" style="color:#6c757d !important;">Sistem Informasi Manajemen Program Sosial Masjid</p>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
