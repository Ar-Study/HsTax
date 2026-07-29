@extends('layouts.app')
@section('title', 'Edit Paket')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Edit Paket</h4>
        </div>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-maroon"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.packages.update', $package) }}">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Icon (emoji)</label>
                        <input type="text" name="icon" class="form-control" maxlength="10" value="{{ $package->icon }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nama Paket <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="{{ $package->name }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Deskripsi Singkat</label>
                        <textarea name="desc" class="form-control" rows="2">{{ $package->desc }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Harga <span class="text-danger">*</span></label>
                        <input type="text" name="price" class="form-control" required value="{{ $package->price }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Periode</label>
                        <input type="text" name="period" class="form-control" value="{{ $package->period }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Urutan</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ $package->sort_order }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Fitur (satu per baris)</label>
                        <textarea name="features" class="form-control" rows="5">{{ is_array($package->features) ? implode("\n", $package->features) : $package->features }}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" name="is_popular" class="form-check-input" id="is_popular" {{ $package->is_popular ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium" for="is_popular">Tandai sebagai paket populer</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-maroon"><i class="bi bi-save"></i> Update Paket</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
