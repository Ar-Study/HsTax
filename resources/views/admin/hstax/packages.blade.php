@extends('layouts.app')

@section('title', 'Paket Layanan - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Paket Layanan</h4>
        <a href="{{ route('admin.hstax.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header"><strong>Tambah Paket Baru</strong></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.hstax.store-package') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Icon (emoji)</label>
                            <input type="text" name="icon" class="form-control" maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Paket *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="desc" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga *</label>
                            <input type="text" name="price" class="form-control" placeholder="Rp 299rb" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Periode</label>
                            <input type="text" name="period" class="form-control" placeholder="per laporan SPT">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fitur (satu per baris)</label>
                            <textarea name="features" class="form-control" rows="4" placeholder="Fitur 1&#10;Fitur 2&#10;Fitur 3"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_popular" class="form-check-input" id="is_popular">
                            <label class="form-check-label" for="is_popular">Paket Paling Populer</label>
                        </div>
                        <button type="submit" class="btn btn-maroon">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><strong>Daftar Paket</strong></div>
                <div class="card-body">
                    @if ($packages->isEmpty())
                        <p class="text-muted">Belum ada paket.</p>
                    @else
                        @foreach ($packages as $pkg)
                            <div class="border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5>{{ $pkg->icon }} {{ $pkg->name }}
                                            @if ($pkg->is_popular)
                                                <span class="badge bg-danger ms-2">Populer</span>
                                            @endif
                                        </h5>
                                        <p class="mb-1 text-muted">{{ $pkg->desc }}</p>
                                        <strong class="text-maroon">{{ $pkg->price }}</strong>
                                        <small class="text-muted"> / {{ $pkg->period }}</small>
                                        @if ($pkg->features)
                                            <ul class="mt-2 mb-0 small">
                                                @foreach ($pkg->features as $f)
                                                    <li>{{ $f }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.hstax.edit-package', $pkg) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form method="POST" action="{{ route('admin.hstax.destroy-package', $pkg) }}" onsubmit="return confirm('Hapus paket ini?')">
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
    .text-maroon { color: #8B1A1A; }
    .btn-maroon { background: #8B1A1A; color: #fff; border: none; }
    .btn-maroon:hover { background: #5A0D0D; color: #fff; }
    .card { border: 1px solid #e5dfd9; border-radius: 16px; }
</style>
@endsection
