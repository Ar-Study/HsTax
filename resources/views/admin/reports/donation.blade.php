@extends('layouts.app')
@section('title', 'Laporan Donasi - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Laporan Donasi</h4>
    <div>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>

@php $grandTotal = $donations->sum('amount'); @endphp
<div class="row mb-3">
    <div class="col-md-4">
        <div class="card border-success text-success">
            <div class="card-body text-center">
                <h5>Total Donasi</h5>
                <p class="display-6 fw-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.reports.donation') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Tipe</label>
                    <select name="type" class="form-select">
                        <option value="">Semua</option>
                        <option value="donasi" {{ request('type') === 'donasi' ? 'selected' : '' }}>Donasi</option>
                        <option value="infak" {{ request('type') === 'infak' ? 'selected' : '' }}>Infak</option>
                        <option value="sedekah" {{ request('type') === 'sedekah' ? 'selected' : '' }}>Sedekah</option>
                        <option value="sponsor" {{ request('type') === 'sponsor' ? 'selected' : '' }}>Sponsor</option>
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
                        <th>Tipe</th>
                        <th>Metode</th>
                        <th class="text-end">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $d)
                    <tr>
                        <td>{{ $d->donation_date ? \Carbon\Carbon::parse($d->donation_date)->format('d/m/Y') : $d->created_at->format('d/m/Y') }}</td>
                        <td>{{ $d->jamaah->name ?? 'Anonim' }}</td>
                        <td><span class="badge bg-secondary">{{ $d->type }}</span></td>
                        <td>{{ $d->payment_method ?? '-' }}</td>
                        <td class="text-end">Rp {{ number_format($d->amount, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-3">Belum ada data donasi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="#" class="btn btn-success"><i class="bi bi-download"></i> Export CSV</a>
</div>
@endsection
