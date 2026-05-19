@extends('layouts.app')
@section('title', 'Laporan Bantuan - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Laporan Bantuan</h4>
    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.reports.assistance') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="postponed" {{ request('status') === 'postponed' ? 'selected' : '' }}>Ditunda</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100"><i class="bi bi-filter"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jamaah</th>
                        <th>Tipe Bantuan</th>
                        <th class="text-end">Jumlah Diminta</th>
                        <th class="text-end">Jumlah Disetujui</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                    <tr>
                        <td>{{ $app->application_date ? \Carbon\Carbon::parse($app->application_date)->format('d/m/Y') : $app->created_at->format('d/m/Y') }}</td>
                        <td>{{ $app->jamaah->name ?? '-' }}</td>
                        <td>{{ $app->assistance_type }}</td>
                        <td class="text-end">Rp {{ number_format($app->amount_requested, 0, ',', '.') }}</td>
                        <td class="text-end">{{ $app->amount_approved ? 'Rp ' . number_format($app->amount_approved, 0, ',', '.') : '-' }}</td>
                        <td>
                            @php
                                $badge = match($app->status) {
                                    'pending' => 'warning',
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                    'postponed' => 'info',
                                    default => 'secondary'
                                };
                                $label = match($app->status) {
                                    'pending' => 'Pending',
                                    'approved' => 'Disetujui',
                                    'rejected' => 'Ditolak',
                                    'postponed' => 'Ditunda',
                                    default => $app->status
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $label }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-3">Belum ada data bantuan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
