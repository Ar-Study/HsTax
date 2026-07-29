@extends('layouts.app')
@section('title', 'Halaman Depan - HS Tax CMS')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Halaman Depan</h4>
            <small class="text-muted">Kelola konten utama website HS Tax</small>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"> {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button> </div>
    @endif

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.cms.company') }}" class="text-decoration-none">
                <div class="card text-center p-4 h-100 border-hover">
                    <div class="mb-3"><i class="bi bi-building fs-1 text-maroon"></i></div>
                    <h6 class="fw-bold">Profil Perusahaan</h6>
                    <p class="small text-muted mb-0">Nama, tagline, hero section, copyright</p>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.cms.contact') }}" class="text-decoration-none">
                <div class="card text-center p-4 h-100 border-hover">
                    <div class="mb-3"><i class="bi bi-telephone fs-1 text-maroon"></i></div>
                    <h6 class="fw-bold">Kontak</h6>
                    <p class="small text-muted mb-0">Email, telepon, alamat, jam kerja, WhatsApp</p>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.cms.social') }}" class="text-decoration-none">
                <div class="card text-center p-4 h-100 border-hover">
                    <div class="mb-3"><i class="bi bi-share fs-1 text-maroon"></i></div>
                    <h6 class="fw-bold">Media Sosial</h6>
                    <p class="small text-muted mb-0">Instagram, TikTok</p>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.cms.services') }}" class="text-decoration-none">
                <div class="card text-center p-4 h-100 border-hover">
                    <div class="mb-3"><i class="bi bi-star fs-1 text-maroon"></i></div>
                    <h6 class="fw-bold">Layanan Unggulan</h6>
                    <p class="small text-muted mb-0">"Kenapa HS Tax?" cards</p>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <a href="{{ route('admin.packages.index') }}" class="text-decoration-none">
                <div class="card text-center p-4 border-hover">
                    <div class="mb-3"><i class="bi bi-box-seam fs-1 text-maroon"></i></div>
                    <h6 class="fw-bold">Paket Layanan</h6>
                    <p class="small text-muted mb-0">{{ App\Models\HstaxPackage::count() }} paket tersedia</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.testimonials.index') }}" class="text-decoration-none">
                <div class="card text-center p-4 border-hover">
                    <div class="mb-3"><i class="bi bi-star fs-1 text-maroon"></i></div>
                    <h6 class="fw-bold">Testimoni</h6>
                    <p class="small text-muted mb-0">{{ App\Models\HstaxTestimonial::count() }} testimoni</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.faqs.index') }}" class="text-decoration-none">
                <div class="card text-center p-4 border-hover">
                    <div class="mb-3"><i class="bi bi-question-circle fs-1 text-maroon"></i></div>
                    <h6 class="fw-bold">FAQ</h6>
                    <p class="small text-muted mb-0">{{ App\Models\HstaxFaq::count() }} pertanyaan</p>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
.border-hover { transition: all 0.2s ease; border: 1px solid #e5dfd9; }
.border-hover:hover { border-color: #8B1A1A; transform: translateY(-3px); box-shadow: 0 6px 20px rgba(139,26,26,0.08); }
</style>
@endsection
