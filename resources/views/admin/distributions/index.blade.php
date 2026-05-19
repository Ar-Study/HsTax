@extends('layouts.app')
@section('title', 'Distribusi Bantuan - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Distribusi Bantuan</h4>
    <a href="{{ route('admin.distributions.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Distribusi</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.distributions.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Metode</label>
                    <select name="method" class="form-select">
                        <option value="">Semua</option>
                        <option value="cash" {{ request('method') === 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="transfer" {{ request('method') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="goods" {{ request('method') === 'goods' ? 'selected' : '' }}>Barang</option>
                        <option value="other" {{ request('method') === 'other' ? 'selected' : '' }}>Lainnya</option>
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
                        <th>Tipe</th>
                        <th class="text-end">Jumlah</th>
                        <th>Metode</th>
                        <th>Distributor</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($distributions as $d)
                    <tr>
                        <td>{{ $d->distribution_date ? \Carbon\Carbon::parse($d->distribution_date)->format('d/m/Y') : $d->created_at->format('d/m/Y') }}</td>
                        <td>{{ $d->application->jamaah->name ?? '-' }}</td>
                        <td>{{ $d->application->assistance_type ?? '-' }}</td>
                        <td class="text-end">Rp {{ number_format($d->amount, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($d->method ?? $d->distribution_method) }}</td>
                        <td>{{ $d->distributor ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.distributions.show', $d) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-3">Belum ada data distribusi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
