@extends('layouts.app')
@section('title', 'Data Donasi - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Donasi</h4>
    <a href="{{ route('admin.donations.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Donasi</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.donations.index') }}">
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
                        <th>Metode Bayar</th>
                        <th class="text-end">Jumlah</th>
                        <th class="text-center">Aksi</th>
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
                        <td class="text-center">
                            <a href="{{ route('admin.donations.edit', $d) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.donations.destroy', $d) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus donasi ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-3">Belum ada data donasi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">{{ $donations->links() }}</div>
</div>
@endsection
