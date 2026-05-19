@extends('layouts.app')
@section('title', 'Tambah Jamaah - MosqueCare')
@section('content')
<div class="card">
    <div class="card-header"><h5>Tambah Jamaah</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.jamaah.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kondisi Ekonomi</label>
                    <select name="kondisi_ekonomi" class="form-select">
                        <option value="">-- Pilih --</option>
                        <option value="rendah" {{ old('kondisi_ekonomi') === 'rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="menengah" {{ old('kondisi_ekonomi') === 'menengah' ? 'selected' : '' }}>Menengah</option>
                        <option value="tinggi" {{ old('kondisi_ekonomi') === 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggungan</label>
                    <input type="number" name="tanggungan" class="form-control" value="{{ old('tanggungan', 0) }}" min="0">
                </div>
                <div class="col-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Catatan</label>
                    <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('admin.jamaah.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
