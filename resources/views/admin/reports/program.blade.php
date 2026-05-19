@extends('layouts.app')
@section('title', 'Laporan Program - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Laporan Program</h4>
    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.reports.program') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="planned" {{ request('status') === 'planned' ? 'selected' : '' }}>Planned</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                        <th>Nama</th>
                        <th>Periode</th>
                        <th class="text-end">Estimasi Anggaran</th>
                        <th class="text-end">Realisasi Anggaran</th>
                        <th class="text-end">Sisa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalEstimated = 0;
                        $totalActual = 0;
                    @endphp
                    @forelse($programs as $p)
                    @php
                        $estimated = $p->estimated_budget ?? 0;
                        $actual = $p->actual_budget ?? 0;
                        $remaining = $estimated - $actual;
                        $totalEstimated += $estimated;
                        $totalActual += $actual;
                    @endphp
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->start_date ? \Carbon\Carbon::parse($p->start_date)->format('d/m/Y') : '-' }} - {{ $p->end_date ? \Carbon\Carbon::parse($p->end_date)->format('d/m/Y') : '-' }}</td>
                        <td class="text-end">Rp {{ number_format($estimated, 0, ',', '.') }}</td>
                        <td class="text-end">Rp {{ number_format($actual, 0, ',', '.') }}</td>
                        <td class="text-end">
                            <span class="{{ $remaining < 0 ? 'text-danger' : 'text-success' }}">
                                Rp {{ number_format($remaining, 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            @php
                                $badge = match($p->status) {
                                    'active' => 'success',
                                    'planned' => 'info',
                                    'completed' => 'secondary',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ ucfirst($p->status) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-3">Belum ada data program</td></tr>
                    @endforelse
                </tbody>
                @if($programs->count() > 0)
                <tfoot class="table-light fw-bold">
                    <tr>
                        <td colspan="2" class="text-end">Total</td>
                        <td class="text-end">Rp {{ number_format($totalEstimated, 0, ',', '.') }}</td>
                        <td class="text-end">Rp {{ number_format($totalActual, 0, ',', '.') }}</td>
                        <td class="text-end">Rp {{ number_format($totalEstimated - $totalActual, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
