@extends('layouts.app')

@section('title', 'Edit Testimoni - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Edit Testimoni</h4>
        <a href="{{ route('admin.hstax.testimonials') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.hstax.update-testimonial', $testimonial) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Bintang (1-5) *</label>
                        <select name="stars" class="form-select" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $testimonial->stars == $i ? 'selected' : '' }}>{{ $i }} ★</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Inisial</label>
                        <input type="text" name="initial" class="form-control" value="{{ $testimonial->initial }}" maxlength="10">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nama *</label>
                        <input type="text" name="name" class="form-control" value="{{ $testimonial->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role/Pekerjaan</label>
                        <input type="text" name="role" class="form-control" value="{{ $testimonial->role }}">
                    </div>
                    <div class="col-md-6">
                        <div class="form-check" style="margin-top: 32px;">
                            <input type="checkbox" name="is_approved" class="form-check-input" id="is_approved" {{ $testimonial->is_approved ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_approved">Disetujui</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Teks Testimoni *</label>
                        <textarea name="text" class="form-control" rows="4" required>{{ $testimonial->text }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-maroon">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-maroon { background: #8B1A1A; color: #fff; border: none; }
    .btn-maroon:hover { background: #5A0D0D; color: #fff; }
    .card { border: 1px solid #e5dfd9; border-radius: 16px; }
</style>
@endsection
