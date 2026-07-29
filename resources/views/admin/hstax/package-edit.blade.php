@extends('layouts.app')

@section('title', 'Edit Paket - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Edit Paket: {{ $package->name }}</h4>
        <a href="{{ route('admin.hstax.packages') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.hstax.update-package', $package) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Icon (emoji)</label>
                        <input type="text" name="icon" class="form-control" value="{{ $package->icon }}" maxlength="10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nama Paket *</label>
                        <input type="text" name="name" class="form-control" value="{{ $package->name }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Harga *</label>
                        <input type="text" name="price" class="form-control" value="{{ $package->price }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Periode</label>
                        <input type="text" name="period" class="form-control" value="{{ $package->period }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ $package->sort_order }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="desc" class="form-control" rows="2">{{ $package->desc }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Fitur (satu per baris)</label>
                        <textarea name="features" class="form-control" rows="5">{{ $package->features ? implode("\n", $package->features) : '' }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check">
                            <input type="checkbox" name="is_popular" class="form-check-input" id="is_popular" {{ $package->is_popular ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_popular">Paket Paling Populer</label>
                        </div>
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
