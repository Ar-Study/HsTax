@extends('layouts.app')

@section('title', 'Edit Berita - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Edit Berita: {{ $news->title }}</h4>
        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.news.update', $news) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Judul *</label>
                        <input type="text" name="title" class="form-control" value="{{ $news->title }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="author" class="form-control" value="{{ $news->author }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gambar (URL/path)</label>
                        <input type="text" name="image" class="form-control" value="{{ $news->image }}">
                    </div>
                    <div class="col-md-6">
                        <div class="form-check" style="margin-top: 32px;">
                            <input type="checkbox" name="is_published" class="form-check-input" id="is_published" {{ $news->is_published ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">Terbitkan</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Ringkasan (Excerpt)</label>
                        <textarea name="excerpt" class="form-control" rows="2">{{ $news->excerpt }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Konten *</label>
                        <textarea name="content" class="form-control" rows="12" required>{{ $news->content }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-maroon">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-maroon { background: #8B1A1A; color: #fff; border: none; }
    .btn-maroon:hover { background: #5A0D0D; color: #fff; }
    .card { border: 1px solid #e5dfd9; border-radius: 16px; }
</style>
@endsection
