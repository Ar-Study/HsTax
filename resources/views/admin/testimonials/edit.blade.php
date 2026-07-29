@extends('layouts.app')
@section('title', 'Edit Testimoni')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Edit Testimoni</h4>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-maroon"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul></div>
    @endif

    <div class="card">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Bintang <span class="text-danger">*</span></label>
                        <select name="stars" class="form-select" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $testimonial->stars == $i ? 'selected' : '' }}>{{ $i }} ★</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Inisial</label>
                        <input type="text" name="initial" class="form-control" maxlength="10" value="{{ $testimonial->initial }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="{{ $testimonial->name }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Role / Pekerjaan</label>
                        <input type="text" name="role" class="form-control" value="{{ $testimonial->role }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Teks Testimoni <span class="text-danger">*</span></label>
                        <textarea name="text" class="form-control" rows="4" required>{{ $testimonial->text }}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ $testimonial->is_approved ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium" for="is_active">Aktif (tampilkan di halaman depan)</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-maroon"><i class="bi bi-save"></i> Update Testimoni</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
