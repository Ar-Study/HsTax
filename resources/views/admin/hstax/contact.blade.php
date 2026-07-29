@extends('layouts.app')
@section('title', 'Kontak - HS Tax CMS')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Kontak</h4>
            <small class="text-muted">Informasi kontak yang ditampilkan di halaman depan</small>
        </div>
        <a href="{{ route('admin.cms.index') }}" class="btn btn-outline-maroon"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"> {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button> </div>
    @endif

    <div class="card">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.cms.update-contact') }}">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', config('hstax.contact.email')) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">No. Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', config('hstax.contact.phone')) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Telepon (Formatted)</label>
                        <input type="text" name="phone_formatted" class="form-control" value="{{ old('phone_formatted', config('hstax.contact.phone_formatted')) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Alamat Lengkap</label>
                        <textarea name="address" class="form-control" rows="2">{{ old('address', config('hstax.contact.address')) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Alamat (Pendek)</label>
                        <input type="text" name="address_short" class="form-control" value="{{ old('address_short', config('hstax.contact.address_short')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Jam Kerja</label>
                        <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours', config('hstax.contact.working_hours')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Maps URL</label>
                        <input type="text" name="maps_url" class="form-control" value="{{ old('maps_url', config('hstax.contact.maps_url')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Maps Query</label>
                        <input type="text" name="maps_q" class="form-control" value="{{ old('maps_q', config('hstax.contact.maps_q')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">No. WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" name="wa_number" class="form-control" value="{{ old('wa_number', config('hstax.whatsapp.number')) }}" required>
                        <small class="text-muted">Format: 628xxxxx (tanpa + atau spasi)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">WhatsApp Text</label>
                        <input type="text" name="wa_text" class="form-control" value="{{ old('wa_text', config('hstax.whatsapp.text')) }}">
                        <small class="text-muted">URL-encoded text untuk tombol WhatsApp</small>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-maroon"><i class="bi bi-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
