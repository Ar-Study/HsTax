@extends('layouts.app')
@section('title', 'Edit Donasi - MosqueCare')
@section('content')
<div class="card">
    <div class="card-header"><h5>Edit Donasi</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.donations.update', $donation) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Jamaah</label>
                    <select name="jamaah_id" class="form-select @error('jamaah_id') is-invalid @enderror">
                        <option value="">-- Anonim (tanpa jamaah) --</option>
                        @foreach($jamaah as $j)
                            <option value="{{ $j->id }}" {{ old('jamaah_id', $donation->jamaah_id) == $j->id ? 'selected' : '' }}>{{ $j->name }}</option>
                        @endforeach
                    </select>
                    @error('jamaah_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipe <span class="text-danger">*</span></label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="donasi" {{ old('type', $donation->type) === 'donasi' ? 'selected' : '' }}>Donasi</option>
                        <option value="infak" {{ old('type', $donation->type) === 'infak' ? 'selected' : '' }}>Infak</option>
                        <option value="sedekah" {{ old('type', $donation->type) === 'sedekah' ? 'selected' : '' }}>Sedekah</option>
                        <option value="sponsor" {{ old('type', $donation->type) === 'sponsor' ? 'selected' : '' }}>Sponsor</option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $donation->amount) }}" required min="0">
                    @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Donasi <span class="text-danger">*</span></label>
                    <input type="date" name="donation_date" class="form-control @error('donation_date') is-invalid @enderror" value="{{ old('donation_date', $donation->donation_date ? \Carbon\Carbon::parse($donation->donation_date)->format('Y-m-d') : date('Y-m-d')) }}" required>
                    @error('donation_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="cash" {{ old('payment_method', $donation->payment_method) === 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="transfer" {{ old('payment_method', $donation->payment_method) === 'transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="other" {{ old('payment_method', $donation->payment_method) === 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $donation->description) }}">
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Catatan</label>
                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="2">{{ old('notes', $donation->notes) }}</textarea>
                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
