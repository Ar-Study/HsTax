@extends('layouts.app')
@section('title', 'Edit Jamaah - MosqueCare')
@section('content')
<div class="card">
    <div class="card-header"><h5>Edit Jamaah</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.jamaah.update', $jamaah) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $jamaah->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $jamaah->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $jamaah->phone) }}">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan', $jamaah->pekerjaan) }}">
                    @error('pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kondisi Ekonomi</label>
                    <select name="kondisi_ekonomi" class="form-select @error('kondisi_ekonomi') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="rendah" {{ old('kondisi_ekonomi', $jamaah->kondisi_ekonomi) === 'rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="menengah" {{ old('kondisi_ekonomi', $jamaah->kondisi_ekonomi) === 'menengah' ? 'selected' : '' }}>Menengah</option>
                        <option value="tinggi" {{ old('kondisi_ekonomi', $jamaah->kondisi_ekonomi) === 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                    @error('kondisi_ekonomi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggungan</label>
                    <input type="number" name="tanggungan" class="form-control @error('tanggungan') is-invalid @enderror" value="{{ old('tanggungan', $jamaah->tanggungan) }}" min="0">
                    @error('tanggungan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address', $jamaah->address) }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Catatan</label>
                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="2">{{ old('notes', $jamaah->notes) }}</textarea>
                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('admin.jamaah.show', $jamaah) }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
