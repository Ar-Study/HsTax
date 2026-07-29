@extends('layouts.app')
@section('title', 'Media Sosial - HS Tax CMS')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Media Sosial</h4>
            <small class="text-muted">Tautan media sosial HS Tax</small>
        </div>
        <a href="{{ route('admin.cms.index') }}" class="btn btn-outline-maroon"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"> {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button> </div>
    @endif

    <div class="card">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.cms.update-social') }}">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Instagram URL</label>
                        <input type="text" name="instagram_url" class="form-control" value="{{ old('instagram_url', $instagramUrl ?? config('hstax.social.instagram.url')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Instagram Handle</label>
                        <input type="text" name="instagram_handle" class="form-control" value="{{ old('instagram_handle', $instagramHandle ?? config('hstax.social.instagram.handle')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">TikTok URL</label>
                        <input type="text" name="tiktok_url" class="form-control" value="{{ old('tiktok_url', $tiktokUrl ?? config('hstax.social.tiktok.url')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">TikTok Handle</label>
                        <input type="text" name="tiktok_handle" class="form-control" value="{{ old('tiktok_handle', $tiktokHandle ?? config('hstax.social.tiktok.handle')) }}">
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
