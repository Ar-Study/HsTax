@extends('layouts.app')
@section('title', 'Tambah Testimoni')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Tambah Testimoni</h4>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-maroon"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul></div>
    @endif

    <div class="card">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.testimonials.store') }}">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Bintang <span class="text-danger">*</span></label>
                        <select name="stars" class="form-select" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} ★</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Inisial</label>
                        <input type="text" name="initial" class="form-control" maxlength="10" placeholder="R">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="Rina S.">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Role / Pekerjaan</label>
                        <input type="text" name="role" class="form-control" placeholder="Owner Online Shop">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Teks Testimoni <span class="text-danger">*</span></label>
                        <textarea name="text" class="form-control" rows="4" required placeholder='"Proses lapor SPT jadi rapi..."'></textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                            <label class="form-check-label fw-medium" for="is_active">Aktif (tampilkan di halaman depan)</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-maroon"><i class="bi bi-save"></i> Simpan Testimoni</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
