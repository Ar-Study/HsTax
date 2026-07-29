@extends('layouts.app')

@section('title', 'Testimoni - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Testimoni</h4>
        <a href="{{ route('admin.hstax.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header"><strong>Tambah Testimoni Baru</strong></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.hstax.store-testimonial') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Bintang (1-5) *</label>
                            <select name="stars" class="form-select" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} ★</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teks Testimoni *</label>
                            <textarea name="text" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Inisial (1 karakter)</label>
                            <input type="text" name="initial" class="form-control" maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role/Pekerjaan</label>
                            <input type="text" name="role" class="form-control">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_approved" class="form-check-input" id="is_approved" checked>
                            <label class="form-check-label" for="is_approved">Disetujui</label>
                        </div>
                        <button type="submit" class="btn btn-maroon">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><strong>Daftar Testimoni</strong></div>
                <div class="card-body">
                    @if ($testimonials->isEmpty())
                        <p class="text-muted">Belum ada testimoni.</p>
                    @else
                        @foreach ($testimonials as $t)
                            <div class="border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-warning mb-1">{{ str_repeat('★', $t->stars) }}</div>
                                        <p class="mb-1 fst-italic">"{{ $t->text }}"</p>
                                        <div class="d-flex align-items-center gap-2 mt-2">
                                            <span class="badge bg-maroon rounded-circle" style="width:32px;height:32px;display:inline-flex;align-items:center;justify-content:center;">{{ $t->initial }}</span>
                                            <div>
                                                <strong>{{ $t->name }}</strong>
                                                <small class="text-muted d-block">{{ $t->role }}</small>
                                            </div>
                                        </div>
                                        @if (!$t->is_approved)
                                            <span class="badge bg-warning text-dark mt-1">Menunggu Persetujuan</span>
                                        @endif
                                    </div>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.hstax.edit-testimonial', $t) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form method="POST" action="{{ route('admin.hstax.destroy-testimonial', $t) }}" onsubmit="return confirm('Hapus testimoni ini?')">
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
    .bg-maroon { background: #8B1A1A; color: #fff; }
    .btn-maroon { background: #8B1A1A; color: #fff; border: none; }
    .btn-maroon:hover { background: #5A0D0D; color: #fff; }
    .card { border: 1px solid #e5dfd9; border-radius: 16px; }
</style>
@endsection
