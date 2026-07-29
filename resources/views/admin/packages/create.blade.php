@extends('layouts.app')
@section('title', 'Tambah Paket')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Tambah Paket</h4>
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
            <form method="POST" action="{{ route('admin.packages.store') }}">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Icon (emoji)</label>
                        <input type="text" name="icon" class="form-control" maxlength="10" placeholder="📄">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nama Paket <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="SPT Pribadi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Deskripsi Singkat</label>
                        <textarea name="desc" class="form-control" rows="2" placeholder="Karyawan & freelancer..."></textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Harga <span class="text-danger">*</span></label>
                        <input type="text" name="price" class="form-control" required placeholder="Rp 299rb">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Periode</label>
                        <input type="text" name="period" class="form-control" placeholder="per laporan SPT">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Fitur (satu per baris)</label>
                        <textarea name="features" class="form-control" rows="5" placeholder="Fitur 1&#10;Fitur 2&#10;Fitur 3"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input type="hidden" name="is_popular" value="0">
                            <input type="checkbox" name="is_popular" class="form-check-input" id="is_popular" value="1">
                            <label class="form-check-label fw-medium" for="is_popular">Tandai sebagai paket populer</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-maroon"><i class="bi bi-save"></i> Simpan Paket</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
