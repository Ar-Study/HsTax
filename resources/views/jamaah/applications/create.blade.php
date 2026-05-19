@extends('layouts.app')

@section('title', 'Ajukan Bantuan - MosqueCare')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0">Ajukan Bantuan Baru</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('jamaah.applications.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="assistance_type" class="form-label">Tipe Bantuan</label>
                        <select name="assistance_type" id="assistance_type" class="form-select @error('assistance_type') is-invalid @enderror" required>
                            <option value="">Pilih tipe bantuan</option>
                            <option value="Biaya Pendidikan" @selected(old('assistance_type') == 'Biaya Pendidikan')>Biaya Pendidikan</option>
                            <option value="Biaya Kesehatan" @selected(old('assistance_type') == 'Biaya Kesehatan')>Biaya Kesehatan</option>
                            <option value="Bantuan Sembako" @selected(old('assistance_type') == 'Bantuan Sembako')>Bantuan Sembako</option>
                            <option value="Bantuan Rumah" @selected(old('assistance_type') == 'Bantuan Rumah')>Bantuan Rumah</option>
                            <option value="Modal Usaha" @selected(old('assistance_type') == 'Modal Usaha')>Modal Usaha</option>
                            <option value="Lainnya" @selected(old('assistance_type') == 'Lainnya')>Lainnya</option>
                        </select>
                        @error('assistance_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount_requested" class="form-label">Jumlah Diminta (Rp)</label>
                        <input type="number" name="amount_requested" id="amount_requested"
                               class="form-control @error('amount_requested') is-invalid @enderror"
                               value="{{ old('amount_requested') }}" min="0" required>
                        @error('amount_requested')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" rows="5"
                                  class="form-control @error('description') is-invalid @enderror"
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('jamaah.applications.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
