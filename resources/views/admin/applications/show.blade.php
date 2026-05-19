@extends('layouts.app')
@section('title', 'Detail Pengajuan Bantuan - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Detail Pengajuan Bantuan</h4>
    <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-sm mb-0">
            <tr><th style="width:180px">Nama Jamaah</th><td>{{ $application->jamaah->name ?? '-' }}</td></tr>
            <tr><th>Email</th><td>{{ $application->jamaah->email ?? '-' }}</td></tr>
            <tr><th>Telepon</th><td>{{ $application->jamaah->phone ?? '-' }}</td></tr>
            <tr><th>Tipe Bantuan</th><td>{{ $application->assistance_type }}</td></tr>
            <tr><th>Jumlah Diminta</th><td>Rp {{ number_format($application->amount_requested, 0, ',', '.') }}</td></tr>
            <tr><th>Jumlah Disetujui</th><td>{{ $application->amount_approved ? 'Rp ' . number_format($application->amount_approved, 0, ',', '.') : '-' }}</td></tr>
            <tr><th>Deskripsi</th><td>{{ $application->description ?? '-' }}</td></tr>
            <tr><th>Tanggal Pengajuan</th><td>{{ $application->application_date ? \Carbon\Carbon::parse($application->application_date)->format('d/m/Y') : $application->created_at->format('d/m/Y') }}</td></tr>
            <tr><th>Tanggal Verifikasi</th><td>{{ $application->verification_date ? \Carbon\Carbon::parse($application->verification_date)->format('d/m/Y') : '-' }}</td></tr>
            <tr><th>Status</th><td>
                @php
                    $badge = match($application->status) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'postponed' => 'info',
                        default => 'secondary'
                    };
                    $label = match($application->status) {
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'postponed' => 'Ditunda',
                        default => $application->status
                    };
                @endphp
                <span class="badge bg-{{ $badge }}">{{ $label }}</span>
            </td></tr>
            <tr><th>Catatan Admin</th><td>{{ $application->admin_note ?? '-' }}</td></tr>
        </table>
    </div>
</div>

@if($application->status === 'pending')
<div class="card mb-4">
    <div class="card-header"><h5>Verifikasi Pengajuan</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.applications.verify', $application) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" id="verifyStatus" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="approved" {{ old('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ old('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="postponed" {{ old('status') === 'postponed' ? 'selected' : '' }}>Ditunda</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6" id="amountApprovedField" style="display:none;">
                    <label class="form-label">Jumlah Disetujui <span class="text-danger">*</span></label>
                    <input type="number" name="amount_approved" class="form-control @error('amount_approved') is-invalid @enderror" value="{{ old('amount_approved') }}" min="0">
                    @error('amount_approved')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Catatan Admin</label>
                    <textarea name="admin_note" class="form-control @error('admin_note') is-invalid @enderror" rows="3">{{ old('admin_note') }}</textarea>
                    @error('admin_note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <button class="btn btn-primary"><i class="bi bi-check-circle"></i> Verifikasi</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif

@if($application->distributions && $application->distributions->count() > 0)
<div class="card">
    <div class="card-header"><h5>Distribusi Bantuan</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($application->distributions as $dist)
                    <tr>
                        <td>{{ $dist->distribution_date ? \Carbon\Carbon::parse($dist->distribution_date)->format('d/m/Y') : '-' }}</td>
                        <td>Rp {{ number_format($dist->amount, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($dist->method ?? $dist->distribution_method) }}</td>
                        <td>{{ $dist->notes ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('verifyStatus');
    const amountField = document.getElementById('amountApprovedField');
    function toggleAmount() {
        amountField.style.display = statusSelect.value === 'approved' ? 'block' : 'none';
    }
    toggleAmount();
    statusSelect.addEventListener('change', toggleAmount);
});
</script>
@endpush
@endsection
