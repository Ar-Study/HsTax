@extends('layouts.app')
@section('title', 'Tambah Distribusi - MosqueCare')
@section('content')
<div class="card">
    <div class="card-header"><h5>Tambah Distribusi</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.distributions.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Pengajuan Bantuan <span class="text-danger">*</span></label>
                    <select name="application_id" class="form-select @error('application_id') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        @foreach($applications as $app)
                            <option value="{{ $app->id }}" {{ old('application_id') == $app->id ? 'selected' : '' }}>
                                {{ $app->jamaah->name ?? 'N/A' }} - {{ $app->assistance_type }} - Rp {{ number_format($app->amount_approved ?? $app->amount_requested, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('application_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required min="0">
                    @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Distribusi <span class="text-danger">*</span></label>
                    <input type="date" name="distribution_date" class="form-control @error('distribution_date') is-invalid @enderror" value="{{ old('distribution_date', date('Y-m-d')) }}" required>
                    @error('distribution_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Metode <span class="text-danger">*</span></label>
                    <select name="method" class="form-select @error('method') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="cash" {{ old('method') === 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="transfer" {{ old('method') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="goods" {{ old('method') === 'goods' ? 'selected' : '' }}>Barang</option>
                        <option value="other" {{ old('method') === 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Keterangan</label>
                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('admin.distributions.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
