<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'HS Tax'))</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body style="background: linear-gradient(135deg, #f8f6f0 0%, #f0e8e0 100%);">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4">
                    <div style="width:60px;height:60px;border-radius:1rem;background:linear-gradient(135deg,#8B1A1A,#A82828);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;color:#D4AF37;font-size:1.5rem;font-weight:800;">
                        HT
                    </div>
                    <h1 class="h3" style="color:#5A0D0D;font-weight:800;">{{ config('app.name', 'HS Tax') }}</h1>
                    <p class="text-muted" style="color:#6c757d !important;">Admin Panel — Konsultan Pajak UMKM & Freelancer</p>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
