<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MosqueCare - Sistem Informasi Manajemen Program Sosial Masjid</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>

{{-- NAVBAR LANDING --}}
<nav class="navbar navbar-expand-lg navbar-dark landing-navbar fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-building"></i> MosqueCare
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="landingNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                <li class="nav-item">
                    <a class="nav-link active" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#manfaat">Manfaat Donasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#penerima">Penerima Bantuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#program">Program</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->isAdmin())
                            <li class="nav-item ms-lg-2">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm px-3" style="background:#d4a373;color:#1b4332;font-weight:600;border:none;">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item ms-lg-2">
                                <a href="{{ route('jamaah.dashboard') }}" class="btn btn-sm px-3" style="background:#d4a373;color:#1b4332;font-weight:600;border:none;">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item ms-lg-2">
                            <a href="{{ route('login') }}" class="btn btn-sm px-3 btn-outline-light">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-sm px-3" style="background:#d4a373;color:#1b4332;font-weight:600;border:none;">
                                    <i class="bi bi-person-plus"></i> Register
                                </a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section id="beranda" class="hero-section">
    <div class="container hero-content">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-7 text-white">
                <span class="badge mb-3 px-3 py-2" style="background:rgba(255,255,255,0.15);font-size:0.85rem;">
                    <i class="bi bi-star-fill text-warning me-1"></i> Platform Sosial Masjid Terpercaya
                </span>
                <h1 class="display-3 fw-bold mb-3" style="line-height:1.15;">
                    Kelola Program Sosial Masjid <span style="color:#d4a373;">dengan Transparan</span>
                </h1>
                <p class="lead mb-4" style="color:rgba(255,255,255,0.85);font-size:1.15rem;">
                    MosqueCare membantu pengurus masjid mengelola donasi, program sosial, 
                    dan penyaluran bantuan kepada jamaah secara terintegrasi, transparan, dan tepat sasaran.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-lg px-4" style="background:#d4a373;color:#1b4332;font-weight:600;border:none;">
                                    <i class="bi bi-speedometer2"></i> Masuk ke Dashboard
                                </a>
                            @else
                                <a href="{{ route('jamaah.dashboard') }}" class="btn btn-lg px-4" style="background:#d4a373;color:#1b4332;font-weight:600;border:none;">
                                    <i class="bi bi-speedometer2"></i> Masuk ke Dashboard
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn btn-lg px-4" style="background:#d4a373;color:#1b4332;font-weight:600;border:none;">
                                <i class="bi bi-person-plus"></i> Daftar Sekarang
                            </a>
                            <a href="#manfaat" class="btn btn-lg px-4 btn-outline-light">
                                Pelajari Lebih Lanjut
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <div style="width:380px;height:380px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;margin:auto;border:2px dashed rgba(255,255,255,0.15);">
                    <div style="width:280px;height:280px;border-radius:50%;background:rgba(255,255,255,0.08);display:flex;align-items:center;justify-content:center;flex-direction:column;">
                        <i class="bi bi-building" style="font-size:4rem;color:#d4a373;"></i>
                        <span class="mt-3 fw-bold" style="color:#fff;font-size:1.5rem;">MosqueCare</span>
                        <span style="color:rgba(255,255,255,0.6);font-size:0.9rem;">v1.0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MANFAAT DONASI --}}
<section id="manfaat" class="py-5" style="background:#fff;">
    <div class="container py-5">
        <div class="text-center mb-5 animate-on-scroll">
            <span class="badge px-3 py-2 mb-2" style="background:#2d6a4f;color:#fff;font-size:0.85rem;">Manfaat</span>
            <h2 class="section-title">Mengapa Berdonasi di MosqueCare?</h2>
            <p class="text-muted mt-3" style="max-width:600px;margin:0 auto;">
                Donasi Anda dikelola secara profesional dan transparan untuk program-program sosial masjid yang tepat sasaran.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3 animate-on-scroll">
                <div class="benefit-card card h-100 p-3">
                    <div class="card-body text-center">
                        <div class="card-icon mx-auto">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h5 class="fw-bold" style="color:#1b4332;">Transparan</h5>
                        <p class="text-muted small mb-0">
                            Setiap donasi tercatat dan bisa dipantau secara real-time. 
                            Anda bisa melihat kemana donasi Anda disalurkan melalui laporan keuangan yang akurat.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 animate-on-scroll">
                <div class="benefit-card card h-100 p-3">
                    <div class="card-body text-center">
                        <div class="card-icon mx-auto">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-bold" style="color:#1b4332;">Tepat Sasaran</h5>
                        <p class="text-muted small mb-0">
                            Bantuan disalurkan kepada jamaah yang benar-benar membutuhkan 
                            berdasarkan data dan verifikasi yang ketat oleh pengurus masjid.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 animate-on-scroll">
                <div class="benefit-card card h-100 p-3">
                    <div class="card-body text-center">
                        <div class="card-icon mx-auto">
                            <i class="bi bi-globe"></i>
                        </div>
                        <h5 class="fw-bold" style="color:#1b4332;">Mudah & Online</h5>
                        <p class="text-muted small mb-0">
                            Donasi bisa dilakukan kapan saja dan dimana saja secara online. 
                            Tidak perlu datang ke masjid, cukup beberapa klik dari perangkat Anda.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 animate-on-scroll">
                <div class="benefit-card card h-100 p-3">
                    <div class="card-body text-center">
                        <div class="card-icon mx-auto">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h5 class="fw-bold" style="color:#1b4332;">Laporan Terpadu</h5>
                        <p class="text-muted small mb-0">
                            Setiap program memiliki laporan keuangan dan dampak yang jelas. 
                            Anda bisa melihat laporan donasi, bantuan, dan program secara detail.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PENERIMA BANTUAN --}}
<section id="penerima" class="py-5" style="background:#f8f6f0;">
    <div class="container py-5">
        <div class="text-center mb-5 animate-on-scroll">
            <span class="badge px-3 py-2 mb-2" style="background:#2d6a4f;color:#fff;font-size:0.85rem;">Kriteria</span>
            <h2 class="section-title">Siapa yang Berhak Mendapatkan Bantuan?</h2>
            <p class="text-muted mt-3" style="max-width:600px;margin:0 auto;">
                Bantuan sosial masjid diprioritaskan untuk jamaah yang memenuhi kriteria berikut, 
                berdasarkan data dan verifikasi pengurus masjid.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4 animate-on-scroll">
                <div class="eligibility-card card h-100 p-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="card-icon" style="width:50px;height:50px;font-size:1.25rem;flex-shrink:0;">
                                <i class="bi bi-people"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color:#1b4332;">Fakir & Miskin</h5>
                                <p class="text-muted small mb-0">Prioritas utama</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">
                            Jamaah yang tidak memiliki penghasilan tetap atau penghasilannya 
                            tidak mencukupi kebutuhan dasar sehari-hari. Data diverifikasi 
                            berdasarkan kondisi ekonomi dan pekerjaan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 animate-on-scroll">
                <div class="eligibility-card card h-100 p-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="card-icon" style="width:50px;height:50px;font-size:1.25rem;flex-shrink:0;">
                                <i class="bi bi-heart"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color:#1b4332;">Anak Yatim & Duafa</h5>
                                <p class="text-muted small mb-0">Santunan rutin</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">
                            Anak-anak yang kehilangan orang tua dan keluarga kurang mampu 
                            mendapatkan santunan rutin dan bantuan pendidikan untuk masa depan yang lebih baik.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 animate-on-scroll">
                <div class="eligibility-card card h-100 p-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="card-icon" style="width:50px;height:50px;font-size:1.25rem;flex-shrink:0;">
                                <i class="bi bi-house-door"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color:#1b4332;">Korban Bencana</h5>
                                <p class="text-muted small mb-0">Bantuan darurat</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">
                            Jamaah yang terkena musibah atau bencana alam mendapatkan 
                            bantuan darurat seperti sembako, pakaian, dan kebutuhan pokok lainnya.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 animate-on-scroll">
                <div class="eligibility-card card h-100 p-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="card-icon" style="width:50px;height:50px;font-size:1.25rem;flex-shrink:0;">
                                <i class="bi bi-activity"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color:#1b4332;">Lansia & Sakit Kronis</h5>
                                <p class="text-muted small mb-0">Bantuan kesehatan</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">
                            Jamaah lanjut usia dan yang menderita penyakit kronis 
                            mendapatkan bantuan biaya pengobatan dan perawatan kesehatan secara berkala.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 animate-on-scroll">
                <div class="eligibility-card card h-100 p-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="card-icon" style="width:50px;height:50px;font-size:1.25rem;flex-shrink:0;">
                                <i class="bi bi-book"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color:#1b4332;">Pelajar & Santri</h5>
                                <p class="text-muted small mb-0">Bantuan pendidikan</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">
                            Pelajar dan santri dari keluarga kurang mampu mendapatkan 
                            bantuan biaya pendidikan, perlengkapan sekolah, dan beasiswa.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 animate-on-scroll">
                <div class="eligibility-card card h-100 p-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="card-icon" style="width:50px;height:50px;font-size:1.25rem;flex-shrink:0;">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color:#1b4332;">Pengangguran</h5>
                                <p class="text-muted small mb-0">Bantuan modal usaha</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">
                            Jamaah yang kehilangan pekerjaan atau tidak memiliki pekerjaan 
                            mendapatkan bantuan modal usaha kecil untuk membangun kemandirian ekonomi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROGRAM --}}
<section id="program" class="py-5" style="background:#fff;">
    <div class="container py-5">
        <div class="text-center mb-5 animate-on-scroll">
            <span class="badge px-3 py-2 mb-2" style="background:#2d6a4f;color:#fff;font-size:0.85rem;">Program</span>
            <h2 class="section-title">Program Sosial Masjid</h2>
            <p class="text-muted mt-3" style="max-width:600px;margin:0 auto;">
                Berbagai program sosial yang dikelola masjid untuk membantu jamaah dan masyarakat sekitar.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4 animate-on-scroll">
                <div class="card border-0 h-100" style="border-radius:1rem;overflow:hidden;">
                    <div style="height:8px;background:linear-gradient(90deg,#2d6a4f,#52b788);"></div>
                    <div class="card-body p-4">
                        <div style="width:50px;height:50px;border-radius:0.75rem;background:linear-gradient(135deg,#2d6a4f,#52b788);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.25rem;margin-bottom:1rem;">
                            <i class="bi bi-basket"></i>
                        </div>
                        <h5 class="fw-bold" style="color:#1b4332;">Program Sembako</h5>
                        <p class="text-muted small">
                            Pendistribusian paket sembako kepada jamaah kurang mampu setiap bulan. 
                            Program ini memastikan kebutuhan pokok keluarga terpenuhi dengan baik.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 animate-on-scroll">
                <div class="card border-0 h-100" style="border-radius:1rem;overflow:hidden;">
                    <div style="height:8px;background:linear-gradient(90deg,#2d6a4f,#d4a373);"></div>
                    <div class="card-body p-4">
                        <div style="width:50px;height:50px;border-radius:0.75rem;background:linear-gradient(135deg,#2d6a4f,#d4a373);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.25rem;margin-bottom:1rem;">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <h5 class="fw-bold" style="color:#1b4332;">Bantuan Kesehatan</h5>
                        <p class="text-muted small">
                            Bantuan biaya pengobatan dan perawatan kesehatan bagi jamaah 
                            yang sakit dan tidak mampu membiayai pengobatan secara mandiri.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 animate-on-scroll">
                <div class="card border-0 h-100" style="border-radius:1rem;overflow:hidden;">
                    <div style="height:8px;background:linear-gradient(90deg,#52b788,#d4a373);"></div>
                    <div class="card-body p-4">
                        <div style="width:50px;height:50px;border-radius:0.75rem;background:linear-gradient(135deg,#52b788,#d4a373);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.25rem;margin-bottom:1rem;">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h5 class="fw-bold" style="color:#1b4332;">Beasiswa Pendidikan</h5>
                        <p class="text-muted small">
                            Beasiswa untuk pelajar dan santri berprestasi dari keluarga kurang mampu. 
                            Membantu mereka melanjutkan pendidikan ke jenjang yang lebih tinggi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-5" style="background:linear-gradient(135deg,#1b4332,#2d6a4f);">
    <div class="container py-4 text-center">
        <div class="animate-on-scroll">
            <h2 class="fw-bold text-white mb-3">Siap Bergabung?</h2>
            <p class="text-white-50 mb-4" style="max-width:500px;margin:0 auto;">
                Daftarkan diri Anda sekarang dan mulai berkontribusi dalam program sosial masjid. 
                Bersama kita bangun masjid yang lebih bermanfaat untuk umat.
            </p>
            @if (Route::has('login'))
                @auth
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-lg px-4" style="background:#d4a373;color:#1b4332;font-weight:600;border:none;">
                            <i class="bi bi-speedometer2"></i> Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('jamaah.dashboard') }}" class="btn btn-lg px-4" style="background:#d4a373;color:#1b4332;font-weight:600;border:none;">
                            <i class="bi bi-speedometer2"></i> Masuk ke Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="btn btn-lg px-4" style="background:#d4a373;color:#1b4332;font-weight:600;border:none;">
                        <i class="bi bi-person-plus"></i> Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-lg px-4 btn-outline-light ms-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                @endauth
            @endif
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="landing-footer py-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="fw-bold text-white mb-3">
                    <i class="bi bi-building"></i> MosqueCare
                </h5>
                <p class="text-white-50 small">
                    Sistem Informasi Manajemen Program Sosial Masjid. 
                    Mengelola donasi, program sosial, dan bantuan untuk jamaah secara transparan dan terintegrasi.
                </p>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold text-white mb-3">Menu</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#beranda" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="mb-2"><a href="#manfaat" class="text-white-50 text-decoration-none">Manfaat Donasi</a></li>
                    <li class="mb-2"><a href="#penerima" class="text-white-50 text-decoration-none">Penerima Bantuan</a></li>
                    <li class="mb-2"><a href="#program" class="text-white-50 text-decoration-none">Program</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold text-white mb-3">Kontak</h6>
                <ul class="list-unstyled small text-white-50">
                    <li class="mb-2"><i class="bi bi-geo-alt"></i> Masjid Raya</li>
                    <li class="mb-2"><i class="bi bi-envelope"></i> info@mosquecare.id</li>
                    <li class="mb-2"><i class="bi bi-telephone"></i> (021) 1234-5678</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold text-white mb-3">Ikuti Kami</h6>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-sm" style="background:rgba(255,255,255,0.1);color:#fff;border-radius:0.5rem;">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="btn btn-sm" style="background:rgba(255,255,255,0.1);color:#fff;border-radius:0.5rem;">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="btn btn-sm" style="background:rgba(255,255,255,0.1);color:#fff;border-radius:0.5rem;">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="#" class="btn btn-sm" style="background:rgba(255,255,255,0.1);color:#fff;border-radius:0.5rem;">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
        <hr class="my-3" style="border-color:rgba(255,255,255,0.1);">
        <div class="text-center text-white-50 small">
            &copy; {{ date('Y') }} MosqueCare. All rights reserved.
        </div>
    </div>
</footer>

</body>
</html>
