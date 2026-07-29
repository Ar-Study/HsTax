@extends('layouts.app')
@section('title', 'Edit Berita')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Edit Berita</h4>
        </div>
        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-maroon"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul></div>
    @endif

    <div class="card">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.news.update', $news) }}" id="newsForm">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-medium">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required value="{{ $news->title }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Penulis</label>
                        <input type="text" name="author" class="form-control" value="{{ $news->author }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Gambar (URL/path)</label>
                        <input type="text" name="image" class="form-control" value="{{ $news->image }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Kategori</label>
                        <input type="text" name="category" class="form-control" value="{{ $news->category }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end pb-2">
                        <div class="form-check">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" {{ $news->is_published ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium" for="is_published">Terbitkan</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Ringkasan (Excerpt)</label>
                        <textarea name="excerpt" class="form-control" rows="2">{{ $news->excerpt }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Konten <span class="text-danger">*</span></label>
                        <div id="editor" style="min-height:350px;">{!! $news->content !!}</div>
                        <textarea name="content" id="content" class="d-none" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-maroon"><i class="bi bi-save"></i> Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js">
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1,2,3,false] }],
                ['bold','italic','underline','strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['blockquote','code-block'],
                [{ 'align': [] }],
                ['link'],
                ['clean']
            ]
        }
    });
    document.getElementById('newsForm').addEventListener('submit', function() {
        document.getElementById('content').value = quill.root.innerHTML;
    });
});
</script>
@endpush
