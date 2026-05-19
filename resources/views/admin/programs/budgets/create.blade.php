@extends('layouts.app')
@section('title', 'Tambah Anggaran - MosqueCare')
@section('content')
<div class="card">
    <div class="card-header"><h5>Tambah Anggaran: {{ $program->name }}</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.programs.budgets.store', $program) }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Item <span class="text-danger">*</span></label>
                    <input type="text" name="item_name" class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name') }}" required>
                    @error('item_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Estimasi Biaya <span class="text-danger">*</span></label>
                    <input type="number" name="estimated_cost" class="form-control @error('estimated_cost') is-invalid @enderror" value="{{ old('estimated_cost') }}" required min="0">
                    @error('estimated_cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Biaya Aktual</label>
                    <input type="number" name="actual_cost" class="form-control @error('actual_cost') is-invalid @enderror" value="{{ old('actual_cost') }}" min="0">
                    @error('actual_cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="planned" {{ old('status') === 'planned' ? 'selected' : '' }}>Planned</option>
                        <option value="realized" {{ old('status') === 'realized' ? 'selected' : '' }}>Realized</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('admin.programs.budgets.index', $program) }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
