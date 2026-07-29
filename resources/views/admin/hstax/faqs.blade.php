@extends('layouts.app')

@section('title', 'FAQ - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>FAQ</h4>
        <a href="{{ route('admin.hstax.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header"><strong>Tambah FAQ Baru</strong></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.hstax.store-faq') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pertanyaan *</label>
                            <input type="text" name="question" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban *</label>
                            <textarea name="answer" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-maroon">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><strong>Daftar FAQ</strong></div>
                <div class="card-body">
                    @if ($faqs->isEmpty())
                        <p class="text-muted">Belum ada FAQ.</p>
                    @else
                        @foreach ($faqs as $faq)
                            <div class="border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong>{{ $faq->question }}</strong>
                                        <p class="mb-0 text-muted mt-1 small">{{ Str::limit($faq->answer, 150) }}</p>
                                    </div>
                                    <div class="d-flex gap-1 ms-3">
                                        <a href="{{ route('admin.hstax.edit-faq', $faq) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form method="POST" action="{{ route('admin.hstax.destroy-faq', $faq) }}" onsubmit="return confirm('Hapus FAQ ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-maroon { background: #8B1A1A; color: #fff; border: none; }
    .btn-maroon:hover { background: #5A0D0D; color: #fff; }
    .card { border: 1px solid #e5dfd9; border-radius: 16px; }
</style>
@endsection
