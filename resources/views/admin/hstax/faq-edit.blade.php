@extends('layouts.app')

@section('title', 'Edit FAQ - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Edit FAQ</h4>
        <a href="{{ route('admin.hstax.faqs') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.hstax.update-faq', $faq) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Pertanyaan *</label>
                    <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jawaban *</label>
                    <textarea name="answer" class="form-control" rows="5" required>{{ $faq->answer }}</textarea>
                </div>
                <button type="submit" class="btn btn-maroon">Simpan Perubahan</button>
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
