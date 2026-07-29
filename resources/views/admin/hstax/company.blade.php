@extends('layouts.app')
@section('title', 'Profil Perusahaan - HS Tax CMS')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Profil Perusahaan</h4>
            <small class="text-muted">Informasi perusahaan yang muncul di halaman depan</small>
        </div>
        <a href="{{ route('admin.cms.index') }}" class="btn btn-outline-maroon"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"> {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button> </div>
    @endif

    <div class="card">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.cms.update-company') }}">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', config('hstax.company.name')) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Tagline <span class="text-danger">*</span></label>
                        <input type="text" name="company_tagline" class="form-control" value="{{ old('company_tagline', config('hstax.company.tagline')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Singkatan <span class="text-danger">*</span></label>
                        <input type="text" name="company_short" class="form-control" value="{{ old('company_short', config('hstax.company.short')) }}" required maxlength="50">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-medium">Deskripsi Singkat <span class="text-danger">*</span></label>
                        <input type="text" name="company_description" class="form-control" value="{{ old('company_description', config('hstax.company.description')) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Hero Badge</label>
                        <input type="text" name="company_hero_badge" class="form-control" value="{{ old('company_hero_badge', config('hstax.company.hero_badge')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Logo Path</label>
                        <input type="text" name="logo" class="form-control" value="{{ old('logo', config('hstax.logo')) }}" placeholder="logo.jpeg">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Hero Title <span class="text-danger">*</span></label>
                        <textarea name="company_hero_title" class="form-control" rows="2">{{ old('company_hero_title', config('hstax.company.hero_title')) }}</textarea>
                        <small class="text-muted">Gunakan <code>&lt;em&gt;</code> untuk teks miring, <code>&lt;br&gt;</code> untuk baris baru</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Hero Subtitle</label>
                        <textarea name="company_hero_sub" class="form-control" rows="2">{{ old('company_hero_sub', config('hstax.company.hero_sub')) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Copyright <span class="text-danger">*</span></label>
                        <input type="text" name="company_copyright" class="form-control" value="{{ old('company_copyright', config('hstax.company.copyright')) }}" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-maroon"><i class="bi bi-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
