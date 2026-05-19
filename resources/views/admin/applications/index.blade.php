@extends('layouts.app')
@section('title', 'Pengajuan Bantuan - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Pengajuan Bantuan</h4>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.applications.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="postponed" {{ request('status') === 'postponed' ? 'selected' : '' }}>Ditunda</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tipe Bantuan</label>
                    <select name="assistance_type" class="form-select">
                        <option value="">Semua</option>
                        <option value="uang" {{ request('assistance_type') === 'uang' ? 'selected' : '' }}>Uang</option>
                        <option value="sembako" {{ request('assistance_type') === 'sembako' ? 'selected' : '' }}>Sembako</option>
                        <option value="kesehatan" {{ request('assistance_type') === 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="pendidikan" {{ request('assistance_type') === 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        <option value="lainnya" {{ request('assistance_type') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="col-md-4">
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
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                    <tr>
                        <td>{{ $app->application_date ? \Carbon\Carbon::parse($app->application_date)->format('d/m/Y') : $app->created_at->format('d/m/Y') }}</td>
                        <td>{{ $app->jamaah->name ?? '-' }}</td>
                        <td>{{ $app->assistance_type }}</td>
                        <td class="text-end">Rp {{ number_format($app->amount_requested, 0, ',', '.') }}</td>
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
                        <td class="text-center">
                            <a href="{{ route('admin.applications.show', $app) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-3">Belum ada pengajuan bantuan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">{{ $applications->links() }}</div>
</div>
@endsection
